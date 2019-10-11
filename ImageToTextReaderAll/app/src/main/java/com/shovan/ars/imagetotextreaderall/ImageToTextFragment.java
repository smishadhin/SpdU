package com.shovan.ars.imagetotextreaderall;

import android.app.Fragment;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.ImageView;
import android.widget.LinearLayout;



public class ImageToTextFragment extends Fragment {



    private CheckBox autoFocus;
    private CheckBox useFlash;


    private ImageView imageViewGallery,imageViewCamera,imageViewRealTime;

    public ImageToTextFragment() {
        // Required empty public constructor
    }



    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View RootView= inflater.inflate(R.layout.fragment_image_to_text, container, false);

        imageViewGallery= (ImageView) RootView.findViewById(R.id.imageViewGallery);
        imageViewCamera= (ImageView) RootView.findViewById(R.id.imageViewTakePic);
        imageViewRealTime= (ImageView) RootView.findViewById(R.id.imageViewRealTime);


        ButtonClick();
        return RootView;
    }

    private void ButtonClick(){



        imageViewGallery.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        startActivity(new Intent(getActivity(),GalleryToImage.class));
                    }
                }
        );

        imageViewCamera.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        startActivity(new Intent(getActivity(),CameraToImageToText.class));

                    }
                }
        );

        imageViewRealTime.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {

                        final AlertDialog alert = new AlertDialog.Builder(getActivity()).create();
                        LinearLayout layout = new LinearLayout(getActivity());
                        layout.setOrientation(LinearLayout.VERTICAL);
                        layout.setPadding(45,45,45,45);

                        final Button buttonAdvanceMode = new Button(getActivity());
                        buttonAdvanceMode.setText("Advance Camera");
                        buttonAdvanceMode.setHintTextColor(Color.GRAY);
                        layout.addView(buttonAdvanceMode);

                        final Button buttonNormalMode = new Button(getActivity());
                        buttonNormalMode.setText("Normal Camera");
                        buttonNormalMode.setHintTextColor(Color.GRAY);
                        layout.addView(buttonNormalMode);

                        alert.setView(layout);
                        alert.setTitle("Real Time Text Reader ");
                        alert.setCancelable(true);

                        buttonAdvanceMode.setOnClickListener(
                                new View.OnClickListener() {
                                    @Override
                                    public void onClick(View view) {
                                        final AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(getActivity());
                                        LayoutInflater inflater = getActivity().getLayoutInflater();
                                        View dialogView = inflater.inflate(R.layout.dialog_checkbok_view, null);
                                        dialogBuilder.setView(dialogView);
                                        dialogBuilder.setCancelable(false);

                                        autoFocus=(CheckBox)dialogView.findViewById(R.id.auto_focus);
                                        useFlash=(CheckBox)dialogView.findViewById(R.id.use_flash);
                                        dialogBuilder.setPositiveButton("Go", new DialogInterface.OnClickListener() {
                                            @Override
                                            public void onClick(DialogInterface dialogInterface, int i) {

                                                startActivity(new Intent(getActivity(),AdvanceCameraToText.class)
                                                        .putExtra("autoFocus",autoFocus.isChecked())
                                                .putExtra("useFlash",useFlash.isChecked()));
                                                dialogInterface.dismiss();
                                            }
                                        });

                                        dialogBuilder.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                                            @Override
                                            public void onClick(DialogInterface dialogInterface, int i) {
                                                dialogInterface.dismiss();
                                            }
                                        });
                                        dialogBuilder.show();

                                        alert.dismiss();
                                    }
                                }
                        );

                        buttonNormalMode.setOnClickListener(
                                new View.OnClickListener() {
                                    @Override
                                    public void onClick(View view) {
                                        startActivity(new Intent(getActivity(),Normal_Camera.class));
                                        alert.dismiss();
                                    }
                                }
                        );

                        alert.show();
                    }
                }
        );

    }



    @Override
    public void onStop() {
        super.onStop();
    }





}
