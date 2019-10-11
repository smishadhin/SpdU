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


public class Library_fag extends Fragment {
    SearchView searchView;
    Button buttonPri,buttonHigh,buttonCol,buttonSearch;
    TextView textViewPri1,textViewPri2,textViewPri3,textViewPri4,textViewPri5,
    textViewHigh1,textViewHigh2,textViewHigh3,textViewHigh4,textViewHigh5,
    textViewCol1,textViewCol2,textViewBook;
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

        final View RootView= inflater.inflate(R.layout.fragment_library_fag, container, false);

        searchView= (SearchView) RootView.findViewById(R.id.searchView3);



        textViewPri1= (TextView) RootView.findViewById(R.id.textViewPri1);
        textViewPri2= (TextView) RootView.findViewById(R.id.textViewPri2);
        textViewPri3= (TextView) RootView.findViewById(R.id.textViewPri3);
        textViewPri4= (TextView) RootView.findViewById(R.id.textViewPri4);
        textViewPri5= (TextView) RootView.findViewById(R.id.textViewPri5);

        textViewHigh1= (TextView) RootView.findViewById(R.id.textViewHigh1);
        textViewHigh2= (TextView) RootView.findViewById(R.id.textViewHigh2);
        textViewHigh3= (TextView) RootView.findViewById(R.id.textViewHigh3);
        textViewHigh4= (TextView) RootView.findViewById(R.id.textViewHigh4);
        textViewHigh5= (TextView) RootView.findViewById(R.id.textViewHigh5);

        textViewCol1= (TextView) RootView.findViewById(R.id.textViewCollaga1);
        textViewCol2= (TextView) RootView.findViewById(R.id.textViewCollaga2);

        textViewBook= (TextView) RootView.findViewById(R.id.textViewSearchBook);

        buttonPri= (Button) RootView.findViewById(R.id.buttonPrimarySchool);
        buttonPri.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                       textViewPri1.setText("i");
                        textViewPri2.setText("ii");
                        textViewPri3.setText("iii");
                        textViewPri4.setText("iv");
                        textViewPri5.setText("v");

                        textViewHigh1.setText("");
                        textViewHigh2.setText("");
                        textViewHigh3.setText("");
                        textViewHigh4.setText("");
                        textViewHigh5.setText("");

                        textViewCol1.setText("");
                        textViewCol2.setText("");

                        textViewBook.setText(" ");

                    }
                }
        );

        buttonHigh= (Button) RootView.findViewById(R.id.buttonHighSchool);
        buttonHigh.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewPri1.setText("");
                        textViewPri2.setText("");
                        textViewPri3.setText("");
                        textViewPri4.setText("");
                        textViewPri5.setText("");

                        textViewHigh1.setText("vi");
                        textViewHigh2.setText("vii");
                        textViewHigh3.setText("viii");
                        textViewHigh4.setText("ix");
                        textViewHigh5.setText("x");

                        textViewCol1.setText("");
                        textViewCol2.setText("");

                        textViewBook.setText(" ");

                    }
                }
        );

        buttonCol= (Button) RootView.findViewById(R.id.buttonCollege);
        buttonCol.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewPri1.setText("");
                        textViewPri2.setText("");
                        textViewPri3.setText("");
                        textViewPri4.setText("");
                        textViewPri5.setText("");

                        textViewHigh1.setText("");
                        textViewHigh2.setText("");
                        textViewHigh3.setText("");
                        textViewHigh4.setText("");
                        textViewHigh5.setText("");

                        textViewCol1.setText("xi");
                        textViewCol2.setText("xii");

                        textViewBook.setText(" ");

                    }
                }
        );


        buttonSearch= (Button) RootView.findViewById(R.id.buttonOkLib);
        buttonSearch.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewPri1.setText("");
                        textViewPri2.setText("");
                        textViewPri3.setText("");
                        textViewPri4.setText("");
                        textViewPri5.setText("");

                        textViewHigh1.setText("");
                        textViewHigh2.setText("");
                        textViewHigh3.setText("");
                        textViewHigh4.setText("");
                        textViewHigh5.setText("");

                        textViewCol1.setText("");
                        textViewCol2.setText("");

                 textViewBook.setText("Book");
                    }
                }
        );


        return RootView;
    }
}
