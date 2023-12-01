import domtoimage from 'dom-to-image';
import {saveAs}   from 'file-saver';

window.download = function (domain) {
    var node = document.querySelector('#qrcode svg');
    domtoimage.toBlob(node)
        .then(function (blob) {
            window.saveAs(blob, domain + '.png');
        })
        .catch(function (error) {
            console.error('oops, something went wrong!', error);
        });
}
