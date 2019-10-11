package com.example.shovan21.hackaton;

import android.content.Context;
import android.net.Uri;
import android.os.Bundle;
import android.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;


public class Share_fag extends Fragment {


    TextView textViewSU,textViewComment;
    Button buttonUploadIdea;
    EditText editTextUploadIdea;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View RootView=inflater.inflate(R.layout.fragment_share_fag, container, false);

        textViewSU= (TextView) RootView.findViewById(R.id.textViewStatusUpdate);
        textViewComment= (TextView) RootView.findViewById(R.id.textViewComment);
        editTextUploadIdea= (EditText) RootView.findViewById(R.id.editTextStatus);
        buttonUploadIdea= (Button) RootView.findViewById(R.id.buttonUploadIdea);
        buttonUploadIdea.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        String Idea=editTextUploadIdea.getText().toString();
                        textViewComment.setText("Comment");
                        textViewSU.setText(Idea);
                    }
                }
        );


        return RootView;

    }


}
