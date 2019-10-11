package com.example.shovan21.hackaton;

import android.content.Context;
import android.net.Uri;
import android.os.Bundle;
import android.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.SearchView;
import android.widget.TextView;


public class Communication_fag extends Fragment {

    SearchView searchView;
    Button buttonOk;
    TextView textViewSchool,textViewT1,textViewC1,textViewSMS1,textViewIn1;
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

        final View RootView= inflater.inflate(R.layout.fragment_communication_fag, container, false);

        searchView= (SearchView) RootView.findViewById(R.id.searchView);
        textViewSchool= (TextView) RootView.findViewById(R.id.textViewSchool);
        textViewT1= (TextView) RootView.findViewById(R.id.textViewTeacher1);
        textViewC1= (TextView) RootView.findViewById(R.id.textViewCall1);
        textViewSMS1= (TextView) RootView.findViewById(R.id.textViewSMS1);
        textViewIn1= (TextView) RootView.findViewById(R.id.textViewInfo1);

        buttonOk= (Button) RootView.findViewById(R.id.buttonOkSearch);
        buttonOk.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewSchool.setText("School");
                        textViewT1.setText("Teacher 1");
                        textViewC1.setText("Call");
                        textViewSMS1.setText("Massage");
                        textViewIn1.setText("Info");
                    }
                }
        );

        return RootView;
    }

}
