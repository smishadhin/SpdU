package com.shovan.ars.imagetotextreaderall;

import android.app.Fragment;
import android.content.Context;
import android.database.Cursor;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.GridView;
import android.widget.TextView;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;


public class SaveDataFragment extends Fragment {

    private GridView gridView;
    DataBaseHelper myDB;



    public SaveDataFragment() {
        // Required empty public constructor
    }


    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View RootView= inflater.inflate(R.layout.fragment_save_data, container, false);

        myDB=new DataBaseHelper(getActivity());
        gridView=(GridView)RootView.findViewById(R.id.gridView);

        setGridView();

        return RootView;
    }


    private void setGridView(){

        final ArrayList<SaveDataFelter>arrayList=new ArrayList<>();

        final BaseAdapter adapter = new BaseAdapter() {

            LayoutInflater inflater = LayoutInflater.from(getActivity());

            @Override
            public int getCount() {
                return arrayList.size();
            }

            @Override
            public Object getItem(int position) {
                return arrayList.get(position);
            }

            @Override
            public long getItemId(int position) {
                return 0;
            }

            @Override
            public View getView(int position, View convertView, ViewGroup parent) {

                if (convertView == null) {
                    convertView = inflater.inflate(R.layout.layout_save_data_view, null);
                }

                TextView textViewTitle = (TextView) convertView.findViewById(R.id.textViewTitle);
                TextView textViewDetails = (TextView) convertView.findViewById(R.id.textViewDetalis);
                TextView textViewDateTime = (TextView) convertView.findViewById(R.id.textViewDateTime);

                textViewTitle.setText(arrayList.get(position).Title);
                textViewDetails.setText(arrayList.get(position).Details);
                textViewDateTime.setText(arrayList.get(position).DateTime);


                return convertView;
            }
        };

        gridView.setAdapter(adapter);

        String id,title,details,datetme;
        Cursor res = myDB.getData();
        while (res.moveToNext()) {
            id=res.getString(0);
            title=res.getString(1);
            details=res.getString(2);
            datetme=res.getString(3);


            arrayList.add(new SaveDataFelter(id,title,details,datetme));
            adapter.notifyDataSetChanged();

        }
    }



}
