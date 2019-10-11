/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package rtnmc;

import java.io.File;
import java.io.FileInputStream;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

/**
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
public class LlabSaturday {

    String day, name, courseCode, time, room;
    //   Biodata insert = new Biodata();

    public void saturday(String courseCode, File file) throws Exception {

        boolean a = false;

        FileInputStream fis = new FileInputStream(file);
        XSSFWorkbook myWorkBook = new XSSFWorkbook(fis);
        XSSFSheet mySheet = myWorkBook.getSheetAt(0);
        Row row;
        Cell cell;

        for (int k = 0; k <= mySheet.getLastRowNum(); k++) {
            row = mySheet.getRow(k);
            if (row == null) {
                continue;
            }
            for (int l = 0; l <= row.getLastCellNum(); l++) {
                cell = row.getCell(l);
                if (cell == null) {
                    continue;
                }
                if (cell.getCellType() == Cell.CELL_TYPE_NUMERIC) {
                    continue;
                } else if (cell.getCellType() == Cell.CELL_TYPE_STRING) {
                    if (cell.getStringCellValue().equals("Saturday")) {
                        day = "Saturday";
                        int i = row.getRowNum();
                        int time = i;
                        int j = cell.getColumnIndex();

                        //courseinfo start
                        for (int r = i; r <= mySheet.getLastRowNum(); r++) {
                            Row row1 = mySheet.getRow(r);
                            if (row1 == null) {
                                continue;
                            }
                            for (int c = j; c <= row1.getLastCellNum(); c++) {
                                Cell cell1 = row1.getCell(c);
                                if (cell1 == null) {
                                    continue;
                                }
                                if (cell1.getCellType() == cell1.CELL_TYPE_NUMERIC) {
                                    //System.out.print(cell1.getNumericCellValue());
                                    continue;
                                }
                                if (cell1.getCellType() == cell1.CELL_TYPE_BLANK) {
                                    continue;
                                }
                                if (cell1.getCellType() == cell1.CELL_TYPE_STRING) {

                                    if (cell1.getStringCellValue().equals("Lab (Electrical Circuit, Digital Electronics, Electronic Devices and Circuits)")) {

                                        for (int ro = i; ro <= mySheet.getLastRowNum(); ro++) {
                                            Row row1o = mySheet.getRow(ro);
                                            if (row1o == null) {
                                                continue;
                                            }
                                            for (int co = j; co <= row1o.getLastCellNum(); co++) {
                                                Cell cell1o = row1o.getCell(co);
                                                if (cell1o == null) {
                                                    continue;
                                                }
                                                if (cell1o.getCellType() == cell1o.CELL_TYPE_NUMERIC) {
                                                    //System.out.print(cell1.getNumericCellValue());
                                                    continue;
                                                }
                                                if (cell1o.getCellType() == cell1o.CELL_TYPE_BLANK) {
                                                    continue;
                                                }
                                                if (cell1o.getCellType() == cell1o.CELL_TYPE_STRING) {

                                                    if (cell1o.getStringCellValue().equals(courseCode)) {
                                                        String courseCodef = cell1o.getStringCellValue();
                                                        //int tr = row1.getRowNum();
                                                        //int tc = cell1.getColumnIndex();
                                                        //Cell cell2=row1.getCell(c-1);
                                                        int cl = co + 1;
                                                        int cl2 = co;

                                                        Row timeRow = mySheet.getRow(time + 1);
                                                        Cell timeCell = timeRow.getCell(cl2 - 1);
//  System.out.println(timeRow.getCell(cl2-1));
                                                        Cell teacher = row1o.getCell(cl);
                                                        Cell room = row1o.getCell(0);
                                                        if (teacher.getCellType() == teacher.CELL_TYPE_BLANK) {
                                                            cl = co + 2;
                                                            teacher = row1.getCell(cl);

                                                        }

                                                        //////////////////////////////database////////////////////////////////////
                                                        //course = courseCell.toString();
                                                        String classTime = timeCell.toString();
                                                        String roomNo = room.toString();
                                                        String teacherIniString = teacher.toString();
                                                        classTime = classTime.replaceAll("\\s+", "");
                                                        String courseCodenew = courseCode.replaceAll("\\s+", "");
                                                        ////////////////////////database/////////////////////
                                                        // insert.inserBiodata(day, courseCodenew, teacherIniString, classTime, roomNo);

                                                        System.out.println(day + " (---)" + courseCodenew + " (---) " + teacherIniString + " (---) " + classTime + " (---) " + roomNo);
                                                    }

                                                    if (cell1o.getStringCellValue().equals("Sunday")) {
                                                        a = true;
                                                    }
                                                }
                                            }
                                            if (a == true) {
                                                break;
                                            }
                                        }

                                    }

                                    if (cell1.getStringCellValue().equals("Sunday")) {
                                        a = true;
                                    }
                                }
                            }
                            if (a == true) {
                                break;
                            }
                        }//courseinfo end
                    }
                }
            }
            if (a == true) {//this stop the outer 1st loop
                break;
            }
        }
    }
}
