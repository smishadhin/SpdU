package com.shovan.ars.imagetotextreaderall;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.util.SparseArray;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.google.android.gms.vision.CameraSource;
import com.google.android.gms.vision.Detector;
import com.google.android.gms.vision.text.TextBlock;
import com.google.android.gms.vision.text.TextRecognizer;

import java.io.IOException;

public class Normal_Camera extends AppCompatActivity {

    SurfaceView cameraView;
    TextView textViewCamera;
    CameraSource cameraSource;
    final int RequestCameraPermissionID = 1001;
    boolean flag = false;
    Button buttonRetry,buttonEdit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_normal_camera);


        cameraView = (SurfaceView) findViewById(R.id.surfaceViewNormal);
        textViewCamera = (TextView) findViewById(R.id.textViewNormalCamera);

        buttonRetry= (Button) findViewById(R.id.buttonRetry);
        buttonEdit= (Button) findViewById(R.id.buttonEdit);





        cameraView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                flag=true;
                try {
                    cameraSource.stop();
                    buttonRetry.setBackgroundColor(Color.BLUE);
                    buttonRetry.setText("Retry");
                    buttonEdit.setBackgroundColor(Color.BLUE);
                    buttonEdit.setText("Edit");
                }catch (Exception e){
                    startActivity(new Intent(Normal_Camera.this,Edit_TextActivity.class)
                            .putExtra("TextData",textViewCamera.getText().toString()));
                }


            }
        });

        buttonRetry.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (flag==true) {
                    flag = false;
                    textViewCamera.setText("");
                    buttonEdit.setBackgroundColor(Color.alpha(100));
                    buttonRetry.setBackgroundColor(Color.alpha(100));
                    startActivity(new Intent(getIntent()).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_NO_ANIMATION));

                }else {
                    flag=true;
                    try {
                        cameraSource.stop();
                        buttonRetry.setBackgroundColor(Color.BLUE);
                        buttonRetry.setText("Retry");
                        buttonEdit.setBackgroundColor(Color.BLUE);
                        buttonEdit.setText("Edit");
                    }catch (Exception e){
                        startActivity(new Intent(Normal_Camera.this,Edit_TextActivity.class)
                                .putExtra("Error","There Have Some Problem"));
                    }

                }
            }
        });

        buttonEdit.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {

                        startActivity(new Intent(Normal_Camera.this,Edit_TextActivity.class)
                                .putExtra("TextData",textViewCamera.getText().toString()));
                    }
                }
        );

        setCameraView();


    }


    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        switch (requestCode) {
            case RequestCameraPermissionID: {
                if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                    if (ActivityCompat.checkSelfPermission(this, Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
                        return;
                    }
                    try {
                        cameraSource.start(cameraView.getHolder());
                    } catch (IOException e) {
                        e.printStackTrace();
                    }

                }
            }
            break;
        }
    }


    private void setCameraView(){

        TextRecognizer textRecognizer = new TextRecognizer.Builder(getApplicationContext()).build();
        if (!textRecognizer.isOperational()) {

        } else {

            cameraSource = new CameraSource.Builder(getApplicationContext(), textRecognizer)
                    .setFacing(CameraSource.CAMERA_FACING_BACK)
                    .setRequestedPreviewSize(1280, 1024)
                    .setRequestedFps(2.0f)
                    .setAutoFocusEnabled(true)
                    .build();
            cameraView.getHolder().addCallback(new SurfaceHolder.Callback() {
                @Override
                public void surfaceCreated(SurfaceHolder surfaceHolder) {

                    try {
                        if (ActivityCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {

                            ActivityCompat.requestPermissions(Normal_Camera.this,
                                    new String[]{Manifest.permission.CAMERA},
                                    RequestCameraPermissionID);
                            return;
                        }
                        cameraSource.start(cameraView.getHolder());
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                }

                @Override
                public void surfaceChanged(SurfaceHolder surfaceHolder, int i, int i1, int i2) {

                }

                @Override
                public void surfaceDestroyed(SurfaceHolder surfaceHolder) {
                    cameraSource.stop();
                }
            });

            textRecognizer.setProcessor(new Detector.Processor<TextBlock>() {
                @Override
                public void release() {

                }

                @Override
                public void receiveDetections(Detector.Detections<TextBlock> detections) {

                    final SparseArray<TextBlock> items = detections.getDetectedItems();
                    if(items.size() != 0)
                    {
                        textViewCamera.post(new Runnable() {
                            @Override
                            public void run() {
                                StringBuilder stringBuilder = new StringBuilder();
                                for(int i =0;i<items.size();++i)
                                {
                                    TextBlock item = items.valueAt(i);
                                    stringBuilder.append(item.getValue());
                                    stringBuilder.append("\n");
                                }
                                textViewCamera.setText("");
                                textViewCamera.setText(stringBuilder.toString());
                            }
                        });
                    }
                }
            });
        }
    }

    @Override
    public void onBackPressed() {
        this.finish();
        startActivity(new Intent(Normal_Camera.this,MainActivity.class));
        super.onBackPressed();
    }

    @Override
    protected void onDestroy() {
        this.finish();
        super.onDestroy();
    }

    @Override
    protected void onStop() {
        this.finish();
        super.onStop();
    }
}
