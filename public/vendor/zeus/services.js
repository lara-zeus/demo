var Appointments = {
    $store: null,

    store() {
        return {
            site        : service.site,
            id          : service.id,
            timeSlots   : { min: service.min_time_slots, max: service.max_time_slots },
            oneDayOnly  : !service.is_multi_day,
            days        : [],
            times       : [],

            showSummery   : false,
            summeryData   : '',
            toReplace : '',
            dates: [],

            showModal: false,

            dispatch: '',

            init() {},

            get activeTimes() {
                return this.times.filter(time => time.active);
            },

            get someTimesNotAvailableAllDays() {
                return this.times.some(time => time.available === 2);
            },

            setTimes(times) {
                this.times = [];

                Object.keys(times).forEach(time => this.times.push({
                    'time'     : time,
                    'available': times[time].status,
                    'details'  : times[time].details,
                    'active'   : false,
                }));
            },

            addDate(dateObj, isMultiDay) {
                const dateStr = `${dateObj.getFullYear()}-${pad(dateObj.getMonth() + 1)}-${pad(dateObj.getDate())}`;
                const index = this.dates.findIndex(d => d === dateStr);

                if (index === -1 && !isMultiDay) {
                    this.dates = [];
                }

                if (index === -1 && (this.dates.length === 0 || isMultiDay)) {
                    this.dates.push(dateStr);
                }

                if (index !== -1 && isMultiDay) {
                    this.dates.splice(index, 1);
                }

                if (index === -1 || (index !== -1 && this.dates[index] !== dateStr) || isMultiDay) {
                    if (this.dates.length) {
                        this.loadTimes();
                    } else {
                        this.setTimes([]);
                    }
                }
            },

            addActiveTime(time) {
                if (!time.active && this.activeTimes.length < this.timeSlots.max) {
                    time.active = true;
                }

                else if (time.active) {
                    time.active = false;
                }
            },

            canReserve() {
                if (this.dates.length === 0) {
                    return false;
                }

                if (!this.oneDayOnly && this.showSummery && !this.isSummeryDataReady()) {
                    return false;
                }

                if (this.oneDayOnly && this.dates.length > 1) {
                    return false;
                }

                return this.activeTimes.length >= this.timeSlots.min;
            },

            activeTimesCountLabel() {
                const times = this.activeTimes.length;

                if (times === 1) {
                    return service.appointmentMsgs.one;
                } else if (times === 2) {
                    return service.appointmentMsgs.two;
                } else if (times >= 3 && times <= 10) {
                    return `${times} ${service.appointmentMsgs.threeToTen}`;
                } else {
                    return `${times} ${service.appointmentMsgs.moreThanTen}`;
                }
            },

            setOneDayOnly(val) {
                this.oneDayOnly = val;

                this.reset(true);

                this.times = [];
            },

            loadTimes() {
                this.reset(false);

                const params = new URLSearchParams();

                this.dates.forEach(date => params.append('date[]', date));

                this.fetch('getTimes', params).then(result => {
                    if (result.status === 2 && result.type === 'success') {
                        this.setTimes(result.data);
                    } else {
                        this.showError(result);
                    }
                });
            },

            nextStep() {
                const params = new URLSearchParams();

                // reserve on day
                if (this.oneDayOnly && this.canReserve()) {
                    params.append('date', this.dates[0]);

                    this.activeTimes.forEach(time => params.append(`time[${this.dates[0]}][]`, time.time));
                }

                // reserve multiple days
                if (!this.oneDayOnly && this.showSummery && this.isSummeryDataReady()) {
                    this.summeryData.forEach(date => {
                        params.append('date[]', date.date);
                        date.times.forEach(time => params.append(`time[${date.date}][]`, time.time));
                    });
                }

                // multiple days summery
                if (!this.oneDayOnly && !this.showSummery) {
                    // show next step
                    this.showSummery = true;

                    this.summeryData = this.dates.map((date) => {
                        const dateObj = new Date(date);
                        return {
                            'date'          : date,
                            'label'         : `${dateObj.getFullYear()}/${pad(dateObj.getMonth()+1)}/${pad(dateObj.getDate())}`,
                            'times'         : copy(this.activeTimes.map(time => time)),
                            'fullyAvailable': function () {
                                return !this.times.some(time => time.details && time.details[this.date] === 0)
                            },
                        }
                    });

                    return;
                }

                if (this.canReserve()) {
                    // send request
                    this.fetch('doResv', params).then(result => {
                        if (result.status === 2) {
                            window.location.href = result.data;
                        } else {
                            this.showError(result);
                        }
                    });
                }
            },

            submit() {
                this.activeDates.forEach(date => params.append('date[]', date.date));
            },

            fetch(endPoint, params) {
                let url = `${EvoUrl}${this.site}/App/Appointments/${endPoint}`;

                const config  = {};

                if (typeof params.append === 'function') {
                    params.append('service', this.id);
                    config.method = 'GET';

                    url = url + '?' + params;
                }
                else {
                    config.method = 'POST';
                    config.headers = { 'Content-Type': 'application/json'};
                    config.body = params;
                }

                return fetch(url, config).then(res => res.json());
            },

            showError(fetchResult) {
                this.dispatch('open-error-modal', fetchResult.msg)
            },

            onReplaceTime(time, date) {
                document.querySelector('#modal-title-1').textContent = date.label;

                this.toReplace = {
                    time : time,
                    date : date,
                };
            },

            replaceTime(time) {
                time = copy(time);
                time.active = true;

                const dateIndex = this.summeryData.findIndex(date => date.date === this.toReplace.date.date);
                const timeIndex = this.summeryData[dateIndex].times.findIndex(time => time.time === this.toReplace.time.time);

                this.summeryData[dateIndex].times[timeIndex].active = false;
                this.summeryData[dateIndex].times[timeIndex] = time;

                this.summeryData[dateIndex].times.sort((a, b) => {
                    return new Date(`${this.summeryData[dateIndex].date} ${b.time}`) - new Date(`${this.summeryData[dateIndex].date} ${a.time}`);
                });

                this.dispatch('close-replace-time');
            },

            prevStep() {
                if (!this.oneDayOnly) {
                    this.showSummery = false;
                }
            },

            reset(days = true) {
                this.times.forEach(time => time.active = false);

                if (days) {
                    this.days.forEach(day => day.active = false);
                }
            },

            isTimeActiveInReplace (targetTime) {
                if (!this.summeryData || !this.showSummery || !this.toReplace) {
                    return false;
                }

                const dateIndex = this.summeryData.findIndex(date => date.date === this.toReplace.date.date);

                if (dateIndex === -1) {
                    return false;
                }

                const timeIndex = this.summeryData[dateIndex].times.findIndex(time => time.time === targetTime.time);

                return timeIndex !== -1 && this.summeryData[dateIndex].times[timeIndex].active;
            },

            isSummeryDataReady() {
                if (!this.showSummery || !this.summeryData) {
                    return false;
                }

                for (let date of this.summeryData) {
                    if (date.times.find(time => time.details && time.details[date.date] === 0)) {
                        return false;
                    }
                }

                return true;
            }
        }
    },
    modal() {
        return {
            open: false,
            date: '',

            get formattedDate() {
                if (!this.date) {
                    return '';
                }

                return `${this.date.toLocaleDateString(service.lang === 'ar' ? 'ar-SA' : 'en-US', {weekday:'long'})} ${this.date.getFullYear()}/${pad(this.date.getMonth()+1)}/${pad(this.date.getDate())}`;
            },

            openModal() {
                this.open = true;
                this.date = '';
                this.$store.services.setTimes([]);

                let otherIndex = datepickerValues.attributes.findIndex(attr => attr.key !== 'timeline');

                while (otherIndex !== -1) {
                    datepickerValues.attributes.splice(otherIndex, 1);

                    otherIndex = datepickerValues.attributes.findIndex(attr => attr.key !== 'timeline');
                }
            },
        }
    },
}

document.addEventListener('alpine:init', () => {
    Alpine.store('services', Appointments.store());
});

const minDateEnd = new Date(datepickerValues.minDate);
const maxDateStart = new Date(datepickerValues.maxDate);

minDateEnd.setDate(minDateEnd.getDate()-1);
maxDateStart.setDate(maxDateStart.getDate()+1);

datepickerValues.attributes.push({
    key: 'timeline',
    dates: {
        start: new Date(null),
        end: minDateEnd
    },
    popover: {
        label: service.disabledMsgs.minDate,
        multi: false
    },
});

datepickerValues.attributes.push({
    key: 'timeline',
    dates: service.timeline.holidays.map(d => new Date(d)),
    popover: {
        label: service.disabledMsgs.holidays,
        multi: false
    },
});

datepickerValues.attributes.push({
    key: 'timeline',
    dates: service.timeline.vacations.map(d => new Date(d)),
    popover: {
        label: service.disabledMsgs.vacations,
        multi: false
    },
});

datepickerValues.attributes.push({
    key: 'timeline',
    dates: service.timeline.unavailable.map(d => new Date(d)),
    popover: {
        label: service.disabledMsgs.unavailable,
        multi: false
    },
});

if (service.is_request_user_unique) {
    datepickerValues.attributes.push({
        key    : 'timeline',
        dates  : service.timeline.unique.map(d => new Date(d)),
        popover: {
            label: service.disabledMsgs.unique,
            multi: false
        },
    });
}

datepickerValues.attributes.push({
    key: 'timeline',
    dates: service.timeline.days_before_req.map(d => new Date(d)),
    popover: {
        label: service.disabledMsgs.days_before_req,
        multi: false
    },
});

datepickerValues.attributes.push({
    key: 'timeline',
    dates: service.timeline.days_after_req.map(d => new Date(d)),
    popover: {
        label: service.disabledMsgs.days_after_req,
        multi: false
    },
});

datepickerValues.attributes.push({
    key: 'timeline',
    dates: {
        start: maxDateStart,
        end: new Date(8640000000000000)
    },
    popover: {
        label: service.disabledMsgs.maxDate,
        multi: false
    },
});

function pad(num) {
    if (typeof num === 'string') {
        num = parseInt(num);
    }

    return num > 9 ? num : "0" + num;
}

function copy(obj) {
    return JSON.parse(JSON.stringify(obj));
}

function daySelected($store, date) {
    $store.services.addDate(date);

    const index = datepickerValues.attributes.findIndex(attr => attr.dates instanceof Date && attr.dates.toDateString() === date.toDateString() && attr.key !== 'timeline');

    // deselect other selected days if exists and select new day
    if (index === -1 && !service.is_multi_day) {
        let otherIndex = datepickerValues.attributes.findIndex(attr => attr.key !== 'timeline');

        while (otherIndex !== -1) {
            datepickerValues.attributes.splice(index, 1);

            otherIndex = datepickerValues.attributes.findIndex(attr => attr.key !== 'timeline');
        }

        datepickerValues.attributes.push({
            dates    : new Date(date),
            highlight: service.selectedDayClasses,
        });
    }
}
