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


public class Events_fag extends Fragment {
    Button buttonPreviousEvent,buttonCurrentEvent,buttonUpcomingEvent,buttonCreate;
    TextView textViewTittle,textViewDetails,textViewTime,textViewVideo,textViewEvent;

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
        final View RootView= inflater.inflate(R.layout.fragment_events_fag, container, false);

        textViewEvent= (TextView) RootView.findViewById(R.id.textViewCurrentUpcomingEvent);
        textViewTittle= (TextView) RootView.findViewById(R.id.textViewEventTitle);
        textViewDetails= (TextView) RootView.findViewById(R.id.textViewEventDetails);
        textViewTime= (TextView) RootView.findViewById(R.id.textViewEventTime);
        textViewVideo= (TextView) RootView.findViewById(R.id.textViewVedioConference);

        buttonCreate= (Button) RootView.findViewById(R.id.buttonCreateEvent);
        buttonPreviousEvent= (Button) RootView.findViewById(R.id.buttonPreviousEvent);
        buttonCurrentEvent= (Button) RootView.findViewById(R.id.buttonCurrentEvent);
        buttonUpcomingEvent= (Button) RootView.findViewById(R.id.buttonUpcomingEvent);

        buttonCreate.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewEvent.setText(" ");
                        textViewTittle.setText("Tittle :");
                        textViewDetails.setText("Details :");
                        textViewTime.setText("Time :");
                        textViewEvent.setText(" ");
                        textViewVideo.setText(" ");
                    }
                }
        );

        buttonUpcomingEvent.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewEvent.setText("Upcoming Event");
                        textViewVideo.setText(" ");
                        textViewTittle.setText(" ");
                        textViewDetails.setText(" ");
                        textViewTime.setText(" ");
                    }
                }
        );

        buttonCurrentEvent.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewEvent.setText("Current Event");
                        textViewVideo.setText("Video Conference");
                        textViewTittle.setText(" ");
                        textViewDetails.setText(" ");
                        textViewTime.setText(" ");
                    }
                }
        );

        buttonPreviousEvent.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        textViewEvent.setText("Previous Event");
                        textViewVideo.setText(" ");
                        textViewTittle.setText(" ");
                        textViewDetails.setText(" ");
                        textViewTime.setText(" ");
                    }
                }
        );

        return RootView;
    }

}
