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

public class FirstApplyActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first_apply);

    }

    public void ApplyFragment(View view){
        Fragment fragment;

        if (view==findViewById(R.id.buttonApplyFirst)){
            fragment=new Apply();
            FragmentManager fm=getFragmentManager();
            FragmentTransaction ft=fm.beginTransaction();
            ft.replace(R.id.fragment3,fragment);
            ft.commit();

        }
        if (view==findViewById(R.id.buttonExam)){
            startActivity(new Intent(FirstApplyActivity.this,ExamActivity.class));
        }

        if (view==findViewById(R.id.buttonResult)){

            fragment= new Result_fag();
            FragmentManager fm=getFragmentManager();
            FragmentTransaction ft=fm.beginTransaction();
            ft.replace(R.id.fragment3,fragment);
            ft.commit();
        }

    }

}
