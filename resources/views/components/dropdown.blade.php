<div class="flex justify-center">
    <div
            x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }
                this.$refs.button.focus()
                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return
                this.open = false
                focusAfter && focusAfter.focus()
            }
        }"
            x-on:keydown.escape.prevent.stop="close($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
            x-id="['dropdown-button']"
            class="relative"
    >
        <!-- Button -->
        <button
                x-ref="button"
                x-on:click="toggle()"
                :aria-expanded="open"
                :aria-controls="$id('dropdown-button')"
                type="button"
                class="text-primary-600 dark:text-primary-100"
        >
            {{ $oppener }}
        </button>

        <!-- Panel -->
        <div
                x-ref="panel"
                x-show="open"
                x-transition.origin.top.left
                x-on:click.outside="close($refs.button)"
                :id="$id('dropdown-button')"
                style="display: none;"
                class="absolute ltr:left-0 rtl:right-0 w-36 bg-white dark:bg-gray-700 text-primary-800 dark:text-primary-100 rounded shadow-md overflow-hidden"
        >
            {{ $slot }}
        </div>
    </div>
</div>
