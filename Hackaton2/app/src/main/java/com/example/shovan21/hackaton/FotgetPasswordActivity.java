package com.example.shovan21.hackaton;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class FotgetPasswordActivity extends AppCompatActivity {

    Button buttonConfirm;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_fotget_password);

        buttonConfirm= (Button) findViewById(R.id.buttonConfirmMail);
        buttonConfirm.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Toast.makeText(FotgetPasswordActivity.this,"Your password changing link has been " +
                                "sent to your mail",Toast.LENGTH_LONG).show();
                    }
                }
        );

    }

}
