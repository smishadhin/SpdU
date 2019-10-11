package com.example.shovan21.hackaton;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;


public class Quality_fag extends Fragment {

    Button buttonTrainingResource,buttonExamTraining,buttonVideoConference;

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
        View RootView= inflater.inflate(R.layout.fragment_quality_fag, container, false);

        buttonTrainingResource= (Button) RootView.findViewById(R.id.buttonTRAININGRESOURCE);
        buttonTrainingResource.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent intent = new Intent(getActivity().getApplicationContext(), QualityTrainingResourceActivity.class);
                        startActivity(intent);
                    }
                }
        );


        buttonExamTraining= (Button) RootView.findViewById(R.id.buttonTrainingExam);
        buttonExamTraining.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent intent = new Intent(getActivity().getApplicationContext(), QualityExamActivity.class);
                        startActivity(intent);
                    }
                }
        );



        buttonVideoConference= (Button) RootView.findViewById(R.id.buttonVIDEOCONFERENCE);
        buttonVideoConference.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent intent = new Intent(getActivity().getApplicationContext(), QualityVideoConferenceActivity.class);
                        startActivity(intent);
                    }
                }
        );


        return RootView;
    }


}
