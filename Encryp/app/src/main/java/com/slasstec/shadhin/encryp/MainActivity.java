package com.slasstec.shadhin.encryp;


import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Random;

public class MainActivity extends AppCompatActivity {

    EditText editText;
    Button button;
    TextView textView;

    Random random;
    ArrayList<DataFilter>arrayList=new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        editText= (EditText) findViewById(R.id.editText);
        button= (Button) findViewById(R.id.button);
        textView= (TextView) findViewById(R.id.textView);

        random=new Random();

        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                inscription(editText.getText().toString());

            }
        });


    }


    private void inscription(String value){
        arrayList.add(new DataFilter('1',1));

//        StringBuilder sb=new StringBuilder(value);
        String s ="";
        String ss="";
        int pos=0;
        int position=value.length();

        while (true){
            int i=0;

            int randomNumber=random.nextInt(position);
            char data = value.charAt(randomNumber);


            System.out.println("outer    "+!arrayList.contains(new DataFilter(data,randomNumber)));
            System.out.println(" s:"+ arrayList.size());
            if (arrayList.contains(new DataFilter('1',1)) ) {
arrayList.remove(new DataFilter('1',1));

//                    sb = sb.deleteCharAt(randomNumber);
                s += String.valueOf(data);
                ss += String.valueOf(data) + "" + String.valueOf(randomNumber);//for test
                arrayList.add(new DataFilter(data, randomNumber));
                pos++;
System.out.println("if  s:"+ arrayList.size());
            } else {
                System.out.println("else  s:"+ arrayList.size());
                while (i<arrayList.size()) {
                    if (arrayList.get(i).c != data && arrayList.get(i).i != randomNumber) {


                        String result=String.valueOf(arrayList.get(i).c);

                        System.out.println("inner if 1  rs: "+result);
                        if (result.isEmpty()) {
//                            sb = sb.deleteCharAt(randomNumber);
                            s += String.valueOf(data);
                            ss += String.valueOf(data) + "" + String.valueOf(randomNumber);//for test
                            arrayList.add(new DataFilter(data, randomNumber));
                            pos++;
                            System.out.println("inner if 2");
                        }

                    }
                    i++;
                    System.out.println("inner");
                }
            }
            System.out.println(pos+"....."+position);
            if (pos>=position){
                System.out.println("break");
                break;
            }



        }

        textView.setText(ss);


    }



}