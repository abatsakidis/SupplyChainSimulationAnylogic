@REM 
@REM Run AnyLogic Experiment
@REM 
@SET DIR_BACKUP_XJAL=%CD%
@CD /D "%~dp0"
@SET DISK_XJAL=C:
@IF NOT [%SystemDrive%]==[] SET DISK_XJAL=%SystemDrive%
@SET PATH_XJAL="%DISK_XJAL%\Program Files\Java\jre6\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%ProgramFiles%\Java\jre6\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%DISK_XJAL%\Program Files (x86)\Java\jre6\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%ProgramFiles(x86)%\Java\jre6\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%DISK_XJAL%\Program Files\Java\jre7\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%ProgramFiles%\Java\jre7\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%DISK_XJAL%\Program Files (x86)\Java\jre7\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%ProgramFiles(x86)%\Java\jre7\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL="%JAVA_HOME%\bin\java.exe"
@IF NOT EXIST %PATH_XJAL% SET PATH_XJAL=java
%PATH_XJAL% -version:1.6+ -cp com.xj.anylogic.engine.jar;com.xj.anylogic.engine.nl.jar;model.jar;lib/mysql-connector-java-5.1.33-bin.jar;com.xj.anylogic.engine.sa.jar -Xmx64m supply_chain.Simulation %*
@CD /D "%DIR_BACKUP_XJAL%"