package com.shovan.ars.imagetotextreaderall;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Calendar;

public class Edit_TextActivity extends AppCompatActivity {

    private TextView textViewError;
    private EditText editTextData;
    private Button buttonSaveData,buttonRetry;
    DataBaseHelper myDb;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit__text);

        myDb=new DataBaseHelper(this);

        textViewError= (TextView) findViewById(R.id.textViewError);
        editTextData= (EditText) findViewById(R.id.editTextData);
        buttonSaveData= (Button) findViewById(R.id.buttonSave);
        buttonRetry= (Button) findViewById(R.id.buttonRetry);

        if (getIntent().getStringExtra("FailImage")!=null){
            textViewError.setText(getIntent().getStringExtra("FailImage"));

        }else if (getIntent().getStringExtra("InvalidImage")!=null){
            textViewError.setText(getIntent().getStringExtra("InvalidImage"));

        }else if (getIntent().getStringExtra("Error")!=null){
            textViewError.setText(getIntent().getStringExtra("Error"));
        }

        editTextData.setText(getIntent().getStringExtra("TextData"));




        buttonRetry.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        new MainActivity().FragmentFlag=true;
                        onBackPressed();
                    }
                }
        );


            getButtonSaveData();



    }







    private void getButtonSaveData(){
        buttonSaveData.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if (!editTextData.getText().toString().equals("")) {

                    new MainActivity().FragmentFlag = false;

                    final AlertDialog.Builder alert = new AlertDialog.Builder(Edit_TextActivity.this);
                    LinearLayout layout = new LinearLayout(Edit_TextActivity.this);
                    layout.setOrientation(LinearLayout.VERTICAL);
                    layout.setPadding(45, 45, 45, 45);

                    final EditText editTextTitle = new EditText(Edit_TextActivity.this);
                    editTextTitle.setHint("Title");
                    layout.addView(editTextTitle);

                    final EditText editTextDetails = new EditText(Edit_TextActivity.this);
                    editTextDetails.setHint("Details");
                    editTextDetails.setText(editTextData.getText().toString());
                    layout.addView(editTextDetails);

                    alert.setView(layout);
                    alert.setTitle("Save Data : ");
                    alert.setCancelable(false);
                    alert.setPositiveButton("Save", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {

                            myDb.insertData(editTextTitle.getText().toString().toUpperCase(), editTextDetails.getText().toString(), getDateTime());
                            dialogInterface.dismiss();
                            onBackPressed();
                        }
                    });

                    alert.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {

                            dialogInterface.dismiss();
                        }
                    });
                    alert.show();


                } else {
                    Toast.makeText(Edit_TextActivity.this, "No Data To Save !", Toast.LENGTH_SHORT).show();
                }
            }
        });


    }


    private String getDateTime(){
        int YYear, MMonth, DDay;

        Calendar calendar = Calendar.getInstance();
        YYear = calendar.get(Calendar.YEAR);
        MMonth = calendar.get(Calendar.MONTH) + 1;
        DDay = calendar.get(Calendar.DAY_OF_MONTH);


        String y = String.valueOf(YYear);
        String m = "";
        if (MMonth < 10) {
            m = "0" + String.valueOf(MMonth);
        } else {
            m = String.valueOf(MMonth);
        }
        String d = "";
        if (DDay < 10) {
            d = "0" + String.valueOf(DDay);
        } else {
            d = String.valueOf(DDay);
        }

        String Date = (y + "-" + m + "-" + d ).toString();


        int Hour=calendar.get(Calendar.HOUR);
        int Minute=calendar.get(Calendar.MINUTE);

        String h="";
        if (Hour<10){
            h = "0"+String.valueOf(Hour);
        }else {
            h = String.valueOf(Hour);
        }
        String mi="";
        if (Minute<10){
            mi = "0"+String.valueOf(Minute);
        }else {
            mi = String.valueOf(Minute);
        }

        String Time=(h + ":" + mi).toLowerCase();




        return Date+"\n"+Time;
    }


    @Override
    public void onBackPressed() {
        startActivity(new Intent(Edit_TextActivity.this,MainActivity.class));
        super.onBackPressed();
    }
}
