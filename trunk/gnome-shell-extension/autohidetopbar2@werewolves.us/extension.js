////  Original extension: http://fpmurphy.com/gnome-shell-extensions
////  Initial 3.2 conversion from Carlo Marchiori's post: http://www.webupd8.org/2011/06/autohide-top-bar-gnome-shell-extension.html#comment-356318148
////  This version by Kevin Kane: werewolves@werewolves.us

const Lang = imports.lang;
const Mainloop = imports.mainloop;
const Shell = imports.gi.Shell;
const St = imports.gi.St;
const Overview = imports.ui.overview;
const PopupMenu = imports.ui.popupMenu;
const PanelMenu = imports.ui.panelMenu;
const Main = imports.ui.main;
const Tweener = imports.ui.tweener;

const AUTOHIDE_ANIMATION_TIME = 0.4;
const TIME_DELTA = 1000;


let _height = 25;

function AutoHide() {
    this._init()
}
 
AutoHide.prototype = {

    _init: function() {

		_height = Main.panel.actor.height;
		Main.panel.hidden = false;
		Main.panel.hidetime = 0;

		Main.panel._hidePanel = this._hidePanel;
		Main.panel._showPanel = this._showPanel;
		Main.panel._toggleHideable = this._toggleHideable;
		Main.panel._pinIt = this._pinIt;

    },//_init

	_pinIt: function(pin) {
		//from: http://ubuntuforums.org/showpost.php?p=11438228&postcount=15
		Main.layoutManager.removeChrome(Main.layoutManager.panelBox);
		Main.layoutManager.addChrome(Main.layoutManager.panelBox, { affectsStruts: pin });
	},

	_hidePanel: function() {

		if (!Main.overview.visible && Main.panel.hideable == true) {

			Tweener.addTween(Main.panel.actor,
				         { height: 1,
				           time: AUTOHIDE_ANIMATION_TIME,
				           transition: 'easeOutQuad'
				         });
			Tweener.addTween(Main.panel._leftCorner.actor,
				         { y: 0,
				           time: AUTOHIDE_ANIMATION_TIME,
				           transition: 'easeOutQuad'
				         });
			Tweener.addTween(Main.panel._rightCorner.actor,
				         { y: 0,
				           time: AUTOHIDE_ANIMATION_TIME,
				           transition: 'easeOutQuad'
				         });
			Tweener.addTween(Main.panel._leftBox,
				         { opacity: 0,
				           time: AUTOHIDE_ANIMATION_TIME-0.1,
				           transition: 'easeOutQuad'
				         });
			Tweener.addTween(Main.panel._centerBox,
				         { opacity: 0,
				           time: AUTOHIDE_ANIMATION_TIME-0.1,
				           transition: 'easeOutQuad'
				         });
			Tweener.addTween(Main.panel._rightBox,
				         { opacity: 0,
				           time: AUTOHIDE_ANIMATION_TIME-0.1,
				           transition: 'easeOutQuad'
				         });
			Main.panel.hidden = true;

		}

    },//_hidePanel

	_showPanel: function() {

		if (Main.panel.hidden == true) {

		    Tweener.addTween(Main.panel._leftCorner.actor,
		                 { y: _height -1,
		                   time: AUTOHIDE_ANIMATION_TIME+0.1,
		                   transition: 'easeOutQuad'
		                 });
		    Tweener.addTween(Main.panel._rightCorner.actor,
		                 { y: _height -1,
		                   time: AUTOHIDE_ANIMATION_TIME+0.1,
		                   transition: 'easeOutQuad'
		                 });
		    Tweener.addTween(Main.panel.actor,
		                 { height: _height,
		                   time: AUTOHIDE_ANIMATION_TIME,
		                   transition: 'easeOutQuad'
		                 });
		    Tweener.addTween(Main.panel._leftBox,
		                 { opacity: 255,
		                   time: AUTOHIDE_ANIMATION_TIME+0.2,
		                   transition: 'easeOutQuad'
		                 });
		    Tweener.addTween(Main.panel._centerBox,
		                 { opacity: 255,
		                   time: AUTOHIDE_ANIMATION_TIME+0.2,
		                   transition: 'easeOutQuad'
		                 });
		    Tweener.addTween(Main.panel._rightBox,
		                 { opacity: 255,
		                   time: AUTOHIDE_ANIMATION_TIME+0.2,
		                   transition: 'easeOutQuad'
		                 });
		    Main.panel.hidden = false;

		}

	},//_showPanel

	_toggleHideable: function(actor, event) {

	   let ticks = event.get_time();

	   if (Main.panel.hidetime == 0) {
		  Main.panel.hidetime = ticks;
		  return;
	   }

	   if ( (ticks - Main.panel.hidetime) > TIME_DELTA) {
		  Main.panel.hidetime = 0;
		  return;
	   }

	   if (Main.panel.hideable == true) {
		   Main.panel.hideable = false;
		   Main.panel._pinIt(true);
	   } else {
		   Main.panel.hideable = true;
		   Main.panel._pinIt(false);
	   }

	   Main.panel.hidetime = 0;

	},//_toggleHideable
 
    enable: function() {

		Main.panel.hideable = true;
		Main.panel._pinIt(false);

		this._leaveEvent = Main.panel.actor.connect('leave-event', Lang.bind(Main.panel, Main.panel._hidePanel));
		this._enterEvent = Main.panel.actor.connect('enter-event', Lang.bind(Main.panel, Main.panel._showPanel));
		this._buttonEvent = Main.panel.actor.connect('button-release-event', Lang.bind(Main.panel, Main.panel._toggleHideable));
		this._activityCloseEvent = Main.overview.connect('hidden',  Lang.bind(Main.panel, Main.panel._hidePanel));
		this._activityOpenEvent = Main.overview.connect('shown',  Lang.bind(Main.panel, Main.panel._showPanel));

		Main.panel._hidePanel();

    },//enable
 
    disable: function() {

		Main.panel.hideable = false;
		Main.panel._pinIt(true);

        if (this._buttonEvent) {
            Main.panel.actor.disconnect(this._buttonEvent);
            this._buttonEvent = 0;
        }
        if (this._leaveEvent) {
            Main.panel.actor.disconnect(this._leaveEvent);
            this._leaveEvent = 0;
        }
        if (this._enterEvent) {
            Main.panel.actor.disconnect(this._enterEvent);
            this._enterEvent = 0;
        }
        if (this._activityCloseEvent) {
            Main.panel.actor.disconnect(this._activityCloseEvent);
            this._activityCloseEvent = 0;
        }
        if (this._activityOpenEvent) {
            Main.panel.actor.disconnect(this._activityOpenEvent);
            this._activityOpenEvent = 0;
        }

		Main.panel._showPanel();

    }//disable

};//autohide
 
function init() {
    return new AutoHide();
}
