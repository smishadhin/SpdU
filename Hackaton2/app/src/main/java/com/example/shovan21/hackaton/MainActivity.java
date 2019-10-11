package com.example.shovan21.hackaton;

import android.app.AlertDialog;
import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.speech.tts.TextToSpeech;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

import java.util.Locale;

public class MainActivity extends AppCompatActivity {
Button buttonHelp;
    TextToSpeech textToSpeech;
    int result;
    String text;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


                        Fragment fragment;
                        fragment=new Login();
                        FragmentManager fm=getFragmentManager();
                        FragmentTransaction ft=fm.beginTransaction();
                        ft.replace(R.id.fragment,fragment);
                        ft.commit();


        textToSpeech=new TextToSpeech(MainActivity.this, new TextToSpeech.OnInitListener() {
            @Override
            public void onInit(int status) {
                if (status==TextToSpeech.SUCCESS){

                    result=textToSpeech.setLanguage(Locale.ENGLISH);

                }
            }
        });

        buttonHelp= (Button) findViewById(R.id.buttonAppsInfo);
        buttonHelp.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {

                        AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);
                        builder.setCancelable(true);
                        builder.setTitle("Help");
                        builder.setMessage("LOGIN -> Get access to the main application\n" +
                                "\n" +
                                "Registration -> signup for the app (only current techers)\n" +
                                "\n" +
                                "Apply to be a Teacher -> New teacher regestration through a simple mcq test and further govt. exam proccedure\n" +
                                "\n" +
                                "profile -> shows the logged on teacher profile view \n" +
                                "\n" +
                                "Quality test-> identify and judge the progress of the current level of the teachers through some test and then give them their current status of their training\n" +
                                "\n" +
                                "Resourse, libery and events -> To ensure the best training for the teacher they can practice with a huge collection of training resourse which can help them to be qualified theirself to be a good teacher\n" +
                                "\n" +
                                "communication -> communication system for the teacher with other teacher as well as with the parents and students\n" +
                                "\n" +
                                " ");


                        builder.setPositiveButton("Stop", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                textToSpeech.stop();
                                AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);
                                builder.setCancelable(true);
                                builder.setTitle("Help");
                                builder.setMessage("LOGIN -> Get access to the main application\n" +
                                        "\n" +
                                        "Registration -> signup for the app (only current techers)\n" +
                                        "\n" +
                                        "Apply to be a Teacher -> New teacher regestration through a simple mcq test and further govt. exam proccedure\n" +
                                        "\n" +
                                        "profile -> shows the logged on teacher profile view \n" +
                                        "\n" +
                                        "Quality test-> identify and judge the progress of the current level of the teachers through some test and then give them their current status of their training\n" +
                                        "\n" +
                                        "Resourse, libery and events -> To ensure the best training for the teacher they can practice with a huge collection of training resourse which can help them to be qualified theirself to be a good teacher\n" +
                                        "\n" +
                                        "communication -> communication system for the teacher with other teacher as well as with the parents and students\n" +
                                        "\n" +
                                        " .");
                                builder.show();
                            }
                        });

                        builder.show();

                        text = ("LOGIN ,,, Get access to the main application\n\n" +
                                "\n" +
                                "Registration ,,, signup for the app (only current teachers),\n\n" +
                                "\n" +
                                "Apply to be a Teacher ,,, New teacher registration through a simple mcq test and further govt. exam proccedure,\n\n" +
                                "\n" +
                                "profile ,,, shows the logged on teacher profile view, \n\n" +
                                "\n" +
                                "Quality test,,, identify and judge the progress of the current level of the teachers through some test and then give them their current status of their training,\n\n" +
                                "\n" +
                                "Resourse, libery and events ,,, To ensure the best training for the teacher they can practice with a huge collection of training resourse which can help them to be qualified theirself to be a good teacher,\n\n" +
                                "\n" +
                                "communication ,,, communication system for the teacher with other teacher as well as with the parents and students,\n" +
                                "\n" +
                                " , Thank You");
                        textToSpeech.speak(text, TextToSpeech.QUEUE_FLUSH, null);

                    }


                }
        );


    }


    public void ChangeFragment(View view){
        Fragment fragment;

        if (view==findViewById(R.id.buttonLogin)){
            fragment=new Login();
            FragmentManager fm=getFragmentManager();
            FragmentTransaction ft=fm.beginTransaction();
            ft.replace(R.id.fragment,fragment);
            ft.commit();

        }
        if (view==findViewById(R.id.buttonRegestation)){
            fragment= new Regestation();
            FragmentManager fm=getFragmentManager();
            FragmentTransaction ft=fm.beginTransaction();
            ft.replace(R.id.fragment,fragment);
            ft.commit();
        }

        if (view==findViewById(R.id.buttonQualifyTest)){
            startActivity(new Intent(MainActivity.this, FirstApplyActivity.class));
        }

        if (view==findViewById(R.id.buttonEducationSite)){
            fragment= new EducationPage_fag();
            FragmentManager fm=getFragmentManager();
            FragmentTransaction ft=fm.beginTransaction();
            ft.replace(R.id.fragment,fragment);
            ft.commit();
        }

    }

}
