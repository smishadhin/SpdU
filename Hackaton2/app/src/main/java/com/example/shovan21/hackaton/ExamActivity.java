package com.example.shovan21.hackaton;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.speech.tts.TextToSpeech;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class ExamActivity extends AppCompatActivity {

    Button buttonExamStart;
    int n;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_exam);

        buttonExamStart= (Button) findViewById(R.id.buttonStartExam);
        buttonExamStart.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        n=1;
                        while (n!=4) {

                            if (n == 1) {
                                Q1();

                            } else if (n == 2) {
                                Q2();

                            } else if (n == 3) {
                                Q3();

                            }
                        }

                    }
                }
        );

    }
public void Q1() {
    CharSequence[] items = {" A ", " B ", " C ", " D "};

    final AlertDialog.Builder builder = new AlertDialog.Builder(ExamActivity.this);
    builder.setPositiveButton("Submit", new DialogInterface.OnClickListener() {
        @Override
        public void onClick(DialogInterface dialog, int which) {

            dialog.cancel();
        }
    });
    builder.setTitle("3. What is your name ?");

    builder.setSingleChoiceItems(items, -1, new DialogInterface.OnClickListener() {



        public void onClick(DialogInterface dialog, int item) {


            switch (item) {
                case 0:
                    break;
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    break;
            }
        }
    });
    AlertDialog alertDialog = builder.create();
    alertDialog.show();
    n++;

}

    public void Q2() {
        CharSequence[] items = {" 20 ", " 19 ", " 28 ", " 25 "};

        AlertDialog.Builder builder = new AlertDialog.Builder(ExamActivity.this);
        builder.setPositiveButton("Submit", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {


                }

        });

        builder.setTitle("2. Your age ?");

        builder.setSingleChoiceItems(items, -1, new DialogInterface.OnClickListener() {


            public void onClick(DialogInterface dialog, int item) {


                switch (item) {
                    case 0:
                        break;
                    case 1:
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                }
            }
        });
        AlertDialog alertDialog = builder.create();
        alertDialog.show();
        n++;

    }

    public void Q3() {
        CharSequence[] items = {" 20000 ", " 19000 ", " 280000 ", " 250000 "};

        AlertDialog.Builder builder = new AlertDialog.Builder(ExamActivity.this);
        builder.setPositiveButton("Submit", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {


            }
        });

        builder.setTitle("1. Your salary ?");

        builder.setSingleChoiceItems(items, -1, new DialogInterface.OnClickListener() {


            public void onClick(DialogInterface dialog, int item) {


                switch (item) {
                    case 0:
                        break;
                    case 1:
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                }
            }
        });
        AlertDialog alertDialog = builder.create();
        alertDialog.show();
        n++;

    }

}
