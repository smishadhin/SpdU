package com.shovan.ars.imagetotextreaderall;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.SparseArray;

import com.google.android.gms.vision.Frame;
import com.google.android.gms.vision.text.TextBlock;
import com.google.android.gms.vision.text.TextRecognizer;

import java.io.InputStream;

public class GalleryToImage extends AppCompatActivity {

    private TextRecognizer detector;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_gallery_to_image);


        detector = new TextRecognizer.Builder(GalleryToImage.this).build();

        Intent cameraIntent=new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
        startActivityForResult(cameraIntent,100);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == 100 && resultCode == RESULT_OK) {

            try {
                InputStream stream = GalleryToImage.this.getContentResolver().openInputStream(data.getData());
                Bitmap bitmap = BitmapFactory.decodeStream(stream);
                stream.close();


                if (detector.isOperational() && null != bitmap) {//..........
                    Frame frame = new Frame.Builder().setBitmap(bitmap).build();
                    SparseArray<TextBlock> textBlocks = detector.detect(frame);
                    StringBuilder sb = new StringBuilder();

                    for (int i = 0; i < textBlocks.size(); i++) {
                        TextBlock tb = textBlocks.get(i);
                        sb.append(tb.getValue()).append("\n");
                    }

                    if (textBlocks.size() == 0) {
                        this.finish();
                        startActivity(new Intent(GalleryToImage.this, Edit_TextActivity.class).putExtra("FailImage","Load Fail"));
                    } else {
                        this.finish();
                        startActivity(new Intent(GalleryToImage.this, Edit_TextActivity.class).putExtra("TextData",sb.toString()));
                    }

                } else {
                    this.finish();
                    startActivity(new Intent(GalleryToImage.this, Edit_TextActivity.class).putExtra("InvalidImage","Invalid Image"));
                }

            } catch (Exception e) {
                this.finish();
                startActivity(new Intent(GalleryToImage.this, Edit_TextActivity.class).putExtra("Error","There Have Some Problem"));
            }
        }else {
            this.finish();
            startActivity(new Intent(GalleryToImage.this,MainActivity.class));
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
        startActivity(new Intent(GalleryToImage.this,MainActivity.class));
        super.onBackPressed();
    }
}
