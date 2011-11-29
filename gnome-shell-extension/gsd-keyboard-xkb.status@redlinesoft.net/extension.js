// Creates a system status notification icon for skype
const StatusIconDispatcher = imports.ui.statusIconDispatcher;

function enable() {
    StatusIconDispatcher.STANDARD_TRAY_ICON_IMPLEMENTATIONS['gsd-keyboard-xkb'] = 'gsd-keyboard-xkb';
}

function disable() {
    StatusIconDispatcher.STANDARD_TRAY_ICON_IMPLEMENTATIONS['gsd-keyboard-xkb'] = '';
}

// gnome-shell extension entry point
function init() {
}
