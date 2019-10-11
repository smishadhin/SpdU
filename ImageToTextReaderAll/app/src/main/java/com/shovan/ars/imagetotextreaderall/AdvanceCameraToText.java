package com.shovan.ars.imagetotextreaderall;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import com.google.android.gms.common.api.CommonStatusCodes;

public class AdvanceCameraToText extends AppCompatActivity {

    private static final int RC_OCR_CAPTURE = 9003;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_advance_camera_to_text);

        boolean autoFocus=getIntent().getBooleanExtra("autoFocus",false);
        boolean useFlash=getIntent().getBooleanExtra("useFlash",false);

        Intent intent = new Intent(AdvanceCameraToText.this, OcrCaptureActivity.class);
        intent.putExtra(OcrCaptureActivity.AutoFocus, autoFocus);
        intent.putExtra(OcrCaptureActivity.UseFlash, useFlash);
        startActivityForResult(intent, RC_OCR_CAPTURE);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {

        if(requestCode == RC_OCR_CAPTURE) {
            if (resultCode == CommonStatusCodes.SUCCESS) {
                if (data != null) {
                    String text = data.getStringExtra(OcrCaptureActivity.TextBlockObject);
//                        statusMessage.setText(R.string.ocr_success);
                    this.finish();
                    startActivity(new Intent(AdvanceCameraToText.this, Edit_TextActivity.class).putExtra("TextData",text.toString()));

                } else {
                    this.finish();
                    startActivity(new Intent(AdvanceCameraToText.this, Edit_TextActivity.class).putExtra("FailImage", R.string.ocr_failure));
                }
            } else {
                this.finish();
                startActivity(new Intent(AdvanceCameraToText.this, Edit_TextActivity.class).putExtra("Error", R.string.ocr_error));
            }
        }else {
            super.onActivityResult(requestCode, resultCode, data);
        }
    }

    @Override
    protected void onStop() {
        super.onStop();
    }

    @Override
    protected void onDestroy() {
        this.finish();
        super.onDestroy();
    }

    @Override
    public void onBackPressed() {
        this.finish();
        startActivity(new Intent(AdvanceCameraToText.this,MainActivity.class));
        super.onBackPressed();
    }
}
