import Alpine from 'alpinejs'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import AlpineFloatingUI from '@awcodes/alpine-floating-ui'
import Focus from "@alpinejs/focus"; // optional unless you want to use x-trap

Alpine.plugin(Focus); // optional unless you want to use x-trap
Alpine.plugin(AlpineFloatingUI)
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine

Alpine.start()