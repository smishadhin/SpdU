package com.shovan.ars.imagetotextreaderall;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

/**
 * Created by arssh on 17-Jun-17.
 */

public class DataBaseHelper extends SQLiteOpenHelper {

    public static final String DATABASE_NAME = "Routine_Finder.db";
    public static final String Table_Info = "RoutineData";


    //AllData............
    public static final String COL_1 = "Id";
    public static final String COL_2 = "Title";
    public static final String COL_3 = "Details";
    public static final String COL_4 = "DateTime";





    public DataBaseHelper(Context context) {
        super(context, DATABASE_NAME, null, 1);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {  //Create Table

        db.execSQL("create table " + Table_Info + "(Id INTEGER PRIMARY KEY AUTOINCREMENT,Title TEXT,Details TEXT," +
                "DateTime TEXT)");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + Table_Info);
        onCreate(db);
    }

    public boolean insertData(String title,String details,String datetime) {


        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_2, title);
        contentValues.put(COL_3, details);
        contentValues.put(COL_4, datetime);
        long valu = db.insert(Table_Info, null, contentValues);
        if (valu == -1) {
            return false;
        } else {
            return true;
        }

    }

    public Cursor getData() {
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor res = db.rawQuery("SELECT * FROM " + Table_Info, null);

        return res;
    }

    public Integer deleteData(String id) {
        SQLiteDatabase db = this.getWritableDatabase();
        int data;
        data = db.delete(Table_Info, "Id=?", new String[]{id});
        return data;
    }

    public int updateData(String id, String title,String details,String date) {

        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_1, id);
        contentValues.put(COL_2, title);
        contentValues.put(COL_3, details);
        contentValues.put(COL_4, date);

        return db.update(Table_Info, contentValues, "Id = ?", new String[]{id});
    }

}
