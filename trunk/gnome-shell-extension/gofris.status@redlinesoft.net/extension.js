// Creates a system status notification icon for skype
const StatusIconDispatcher = imports.ui.statusIconDispatcher;

function enable() {
    StatusIconDispatcher.STANDARD_TRAY_ICON_IMPLEMENTATIONS['gofris-en'] = 'gofris-en';
}

function disable() {
    StatusIconDispatcher.STANDARD_TRAY_ICON_IMPLEMENTATIONS['gofris-en'] = '';
}

// gnome-shell extension entry point
function init() {
}
