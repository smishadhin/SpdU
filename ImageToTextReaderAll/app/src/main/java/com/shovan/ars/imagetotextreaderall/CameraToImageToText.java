package com.shovan.ars.imagetotextreaderall;

import android.content.Intent;
import android.graphics.Bitmap;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.SparseArray;
import com.google.android.gms.vision.Frame;
import com.google.android.gms.vision.text.TextBlock;
import com.google.android.gms.vision.text.TextRecognizer;

import java.io.ByteArrayOutputStream;

public class CameraToImageToText extends AppCompatActivity {

    private TextRecognizer detector;
    private static final int PHOTO_REQUEST = 100;
    private static String blocks;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_camera_to_image_to_text);

        detector = new TextRecognizer.Builder(CameraToImageToText.this).build();

        Intent intent = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
        startActivityForResult(intent, PHOTO_REQUEST);

    }



    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == PHOTO_REQUEST && resultCode == RESULT_OK) {


            try {
                Bitmap bitmap = (Bitmap) data.getExtras().get("data");
                ByteArrayOutputStream bytes = new ByteArrayOutputStream();
                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, bytes);

                if (detector.isOperational() && bitmap != null) {
                    Frame frame = new Frame.Builder().setBitmap(bitmap).build();
                    SparseArray<TextBlock> textBlocks = detector.detect(frame);
                    blocks = "";
                    for (int index = 0; index < textBlocks.size(); index++) {
                        TextBlock tBlock = textBlocks.valueAt(index);
                        blocks = blocks + tBlock.getValue() + "\n";

                    }
                    if (textBlocks.size() == 0) {
                        this.finish();
                        startActivity(new Intent(CameraToImageToText.this, Edit_TextActivity.class).putExtra("FailImage","Load Fail"));
                    } else {
                        this.finish();
                        detector.release();
                        startActivity(new Intent(CameraToImageToText.this, Edit_TextActivity.class)
                                .setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK).putExtra("TextData",blocks.toString()));
                    }
                } else {
                    this.finish();
                    startActivity(new Intent(CameraToImageToText.this, Edit_TextActivity.class).putExtra("InvalidImage","Invalid Image"));
                }
            } catch (Exception e) {
                this.finish();
                startActivity(new Intent(CameraToImageToText.this, Edit_TextActivity.class).putExtra("Error","There Have Some Problem"));
            }
        }else {
            this.finish();
            startActivity(new Intent(CameraToImageToText.this,MainActivity.class));
        }


    }


    @Override
    public void onStop() {
        detector.release();
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
        startActivity(new Intent(CameraToImageToText.this,MainActivity.class));
        super.onBackPressed();
    }
}
