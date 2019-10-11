/*
 * This code is written by Muhiminul Islam Shadhin (website: shadhin.slasstec.com) and he is copyright owner
 * Only  Muhiminul Islam Shadhin (website: shadhin.slasstec.com) has the authority to change the code.
 * If you are viewing or editing the code without the permission of  Muhiminul Islam Shadhin (website: shadhin.slasstec.com) then its a crime and you
are breaking the law of copyright.
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
 * @author Muhiminul Islam Shadhin <smi.shadhin at gmail.com>
 */
public class Tuesday {

    String day, name, courseCode, time, room;
    Biodata insert = new Biodata();

    public void tuesday(String courseCode, File file) throws Exception {

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
                    if (cell.getStringCellValue().equals("Tuesday")) {
                        day = "Tuesday";
                        int i = row.getRowNum();
                        int time = i;
                        int j = cell.getColumnIndex();

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

                                    if (cell1.getStringCellValue().equals(courseCode)) {
                                         System.out.println(courseCode);
                                        String courseCodef = cell1.getStringCellValue();
                                        //int tr = row1.getRowNum();
                                        //int tc = cell1.getColumnIndex();
                                        //Cell cell2=row1.getCell(c-1);
                                        int cl = c + 1;
                                        int cl2 = c;
String teacherIniString;
                                        Row timeRow = mySheet.getRow(time + 1);
                                        Cell timeCell = timeRow.getCell(cl2 - 1);
                                        // System.out.println(courseCode);
//  System.out.println(timeRow.getCell(cl2-1));
                                        Cell teacher = row1.getCell(cl);
                                        Cell room = row1.getCell(0);
                                        if (teacher.getCellType() == teacher.CELL_TYPE_BLANK) {
                                            cl = c + 2;
                                            teacher = row1.getCell(cl);
 teacherIniString = "none";
                                        }else {
                                            teacherIniString = teacher.toString().replaceAll("\\s+", "");
                                        }

                                        //////////////////////////////database////////////////////////////////////
                                        //course = courseCell.toString();
                                        String classTime = timeCell.toString();
                                        String roomNo = room.toString().replaceAll("\\s+", "");
                                      //  String teacherIniString = teacher.toString();
                                        classTime = classTime.replaceAll("\\s+", "");
                                        String courseCodenew = courseCode.replaceAll("\\s+", "");
                                        ////////////////////////database/////////////////////
                                         insert.mcinserBiodata(day, courseCodenew, teacherIniString, classTime, roomNo);

                                        System.out.println(day + " (---)" + courseCodenew + " (---) " + teacherIniString + " (---) " + classTime + " (---) " + roomNo);
                                    }

                                    if (cell1.getStringCellValue().equals("Wednesday")||cell1.getStringCellValue().equals("Lab (Electrical Circuit, Digital Electronics, Electronic Devices and Circuits)")) {
                                        a = true;
                                    }
                                }
                            }
                            if (a == true) {
                                break;
                            }
                        }
                    }
                }
            }
            if (a == true) {//this stop the outer 1st loop
                break;
            }
        }
    }
}
