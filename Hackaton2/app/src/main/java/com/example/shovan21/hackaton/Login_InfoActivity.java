package com.example.shovan21.hackaton;

import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;

public class Login_InfoActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login__info);

        Fragment fragment;
        fragment = new Profile_fag();
        FragmentManager fm = getFragmentManager();
        FragmentTransaction ft = fm.beginTransaction();
        ft.replace(R.id.fragment2, fragment);
        ft.commit();

    }

    public void LoginFragment(View view) {
        Fragment fragment;

        if (view == findViewById(R.id.buttonProfile)) {
            fragment = new Profile_fag();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment2, fragment);
            ft.commit();

        }
        if (view == findViewById(R.id.buttonQuality)) {
            fragment = new Quality_fag();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment2, fragment);
            ft.commit();
        }

        if (view == findViewById(R.id.buttonShare)) {
            fragment = new Share_fag();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment2, fragment);
            ft.commit();
        }


        if (view == findViewById(R.id.buttonCommunication)) {
            fragment = new Communication_fag();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment2, fragment);
            ft.commit();

        }
        if (view == findViewById(R.id.buttonEvents)) {
            fragment = new Events_fag();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment2, fragment);
            ft.commit();
        }

        if (view == findViewById(R.id.buttonLibrary)) {
            fragment = new Library_fag();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment2, fragment);
            ft.commit();
        }
        if (view == findViewById(R.id.buttonLogout)) {
            startActivity(new Intent(Login_InfoActivity.this,MainActivity.class));
        }


    }
}
