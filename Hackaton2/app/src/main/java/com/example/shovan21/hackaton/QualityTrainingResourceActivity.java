package com.example.shovan21.hackaton;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class QualityTrainingResourceActivity extends AppCompatActivity {

    TextView textViewResource;
    Button buttonT,buttonS;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_quality_training_resource);


        textViewResource= (TextView) findViewById(R.id.textViewResource);
        buttonT= (Button) findViewById(R.id.buttonTrainingResource);
        buttonT.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {

                        textViewResource.setText("Govt. Training Resource");
                    }
                }
        );

        buttonS= (Button) findViewById(R.id.buttonSubjectRelatedResource);
        buttonS.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {

                        textViewResource.setText("Subject Related Resource");
                    }
                }
        );
    }

}
