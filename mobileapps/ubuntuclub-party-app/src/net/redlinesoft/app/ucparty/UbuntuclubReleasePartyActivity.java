package net.redlinesoft.app.ucparty;

import android.app.Activity;
import android.content.Context;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.view.Window;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

public class UbuntuclubReleasePartyActivity extends Activity {
	
	final Activity activity = this;
	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
    	super.onCreate(savedInstanceState);
		this.getWindow().requestFeature(Window.FEATURE_PROGRESS);
		//this.getWindow().requestFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.main);

		if (!chkStatus()) {
			Toast.makeText(this, "No Network ", Toast.LENGTH_LONG).show();
		} else {

			/**
			 * load webview
			 */
			final WebView webView = (WebView) findViewById(R.id.webView);
			webView.getSettings().setJavaScriptEnabled(true);
			webView.getSettings().setSupportZoom(true);
			webView.getSettings().setBuiltInZoomControls(false);

			/**
			 * progress bar
			 */
			webView.setWebChromeClient(new WebChromeClient() {
				public void onProgressChanged(WebView view, int progress) {
					activity.setTitle("Loading...");
					activity.setProgress(progress * 100);

					if (progress == 100)
						activity.setTitle(R.string.app_name);
				}
			});

			/**
			 * show the same view
			 */
			webView.setWebViewClient(new WebViewClient() {
				@Override
				public void onReceivedError(WebView view, int errorCode,
						String description, String failingUrl) {
					// Handle the error
					webView.loadUrl("about:home");
					Toast.makeText(getApplicationContext(), description,
							Toast.LENGTH_LONG).show();
				}

				@Override
				public boolean shouldOverrideUrlLoading(WebView view, String url) {
					view.loadUrl(url);
					return true;
				}

			});

			/**
			 * load 
			 */
			webView.loadUrl("http://thaiopensource.org/ucparty/index.html");

		}
    }
    
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		return;
	}
	
    
	/**
	 * check status
	 * 
	 * @return
	 */
	public boolean chkStatus() {
		final ConnectivityManager connMgr = (ConnectivityManager) this
				.getSystemService(Context.CONNECTIVITY_SERVICE);

		final android.net.NetworkInfo wifi = connMgr
				.getNetworkInfo(ConnectivityManager.TYPE_WIFI);

		final android.net.NetworkInfo mobile = connMgr
				.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);

		if (wifi.isAvailable()) {
			// Toast.makeText(this, "Wifi" , Toast.LENGTH_LONG).show();
			return true;
		} else if (mobile.isAvailable()) {
			// Toast.makeText(this, "Mobile 3G " , Toast.LENGTH_LONG).show();
			return true;
		} else {
			Toast.makeText(this, "No Network ", Toast.LENGTH_LONG).show();
			return false;
		}

	}
}