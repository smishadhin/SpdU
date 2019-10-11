package onuchokri;

import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

import java.io.File;
import java.io.FileInputStream;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;

public class teacherMon {

    RoutineEvent info = new RoutineEvent();
    String day, teacher, course, classTime, roomNo;

    public void monday(String teacherNm, String teaid, File file) throws Exception {
        //System.out.println("method in");
        boolean a = false;

        FileInputStream fis = new FileInputStream(file);
        XSSFWorkbook myWorkBook = new XSSFWorkbook(fis);
        XSSFSheet mySheet = myWorkBook.getSheetAt(1);
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
                    if (cell.getStringCellValue().equals("M o n d a y")) {
                        day = "Sunday";
                        int i = row.getRowNum();
                        int time = i;
                        int j = cell.getColumnIndex();
                        // System.out.println();
                        // System.out.println(cell.getStringCellValue());
                        //System.out.println();
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
                                    //System.out.print(cell1.getStringCellValue());
                                    if (cell1.getStringCellValue().equals(teacherNm)) {
                                        teacher = cell1.getStringCellValue().toString();
                                        int tr = row1.getRowNum();
                                        int tc = cell1.getColumnIndex();
                                        //Cell cell2=row1.getCell(c-1);
                                        int cl = c - 1;
                                        int cl2 = c - 1;
                                        Row timeRow = mySheet.getRow(time + 1);
                                        Cell timeCell = timeRow.getCell(cl2);
                                        Cell courseCell = row1.getCell(cl);
                                        Cell room = row1.getCell(0);
                                        if (courseCell.getCellType() == courseCell.CELL_TYPE_BLANK) {
                                            cl = c - 2;
                                            courseCell = row1.getCell(cl);
                                            cl2 = c - 2;
                                            timeCell = timeRow.getCell(cl2);
                                        }
                                        //////////////////////////////database////////////////////////////////////
                                        course = courseCell.toString();
                                        classTime = timeCell.toString();
                                        roomNo = room.toString();
                                     //   System.out.println(course);
                                        info.setDay(day);
                                        info.setName(teacher);
                                        info.setCourseCode(course);
                                        info.setTime(classTime);
                                        info.setRoom(roomNo);

                                        try {
                                            Class.forName("org.sqlite.JDBC");
                                            Connection connection = DriverManager.getConnection("jdbc:sqlite:teacherinfo.db");
                                            connection.setAutoCommit(false);
                                            Statement stmt = connection.createStatement();
                                            Statement stmttitle = connection.createStatement();
                                            String sql2 = "INSERT INTO information (teacherinitial,teacherid,coursecode,coursetitle) "
                                                    + "VALUES (?,?,?,?);";

                                            ResultSet rs = stmttitle.executeQuery("SELECT  coursecode,coursetitle FROM course");
                                            String  courseTitleString=null;
                                            while (rs.next()) {
                                                String coucoString = rs.getString("coursecode");
                                                String coutiString = rs.getString("coursetitle");
                                                if (course.contains(coucoString)) {
                                                    courseTitleString = coutiString;
                                                    break;
                                                }
                                            }
                                            rs.close();
                                            stmttitle.close();

                                            PreparedStatement pst = connection.prepareStatement(sql2);
                                            pst.setString(1, teacher);
                                            pst.setString(2, teaid);
                                            pst.setString(3, course);
                                            pst.setString(4, courseTitleString);

                                            pst.execute();
                                            stmt.close();

                                            connection.commit();
                                            connection.close();

                                        } catch (Exception e) {
                                          //  System.err.println(e.getClass().getName() + ": " + e.getMessage());
                                           // System.exit(0);
                                        }
                                        //    System.out.println(day+" "+teacher+" "+courseCell+" "+timeCell+" "+room);

                                    }
                                    if (cell1.getStringCellValue().equals("T u e s d a y")) {
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
