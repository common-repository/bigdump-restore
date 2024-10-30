=== bigdump-restore Restore and clone Very Large Databases with Big Dump ===
Contributors: sminozzi
Tags: Tags: Restore large database, Import database , Recover database, Restoring database, Load database
Requires at least: 5.2
Tested up to: 6.6
Stable tag: 1.24
Requires PHP: 5.6 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Install the free Bigdump (PHP script GUI Web Based Tool) to restore large and very large SQL database. No php Code edit and no linux command.

== Description ==
**BigDump Restore Plugin**
★★★★★<br>
BigDump PHP script is a highly reputed MySQL Dump Importer designed to facilitate the import of large MySQL databases that exceed the capabilities of conventional methods like phpMyAdmin. It is particularly useful for users migrating their website between web hosts or moving a local development site to a remote server.

The BigDump restore plugin enables safe and quick installation and execution of the free BigDump script via a user-friendly GUI (Graphical User Interface), requiring no code modifications or Linux command line operations.

It supports GZip compressed dumps and eliminates the need for FTP when backups are made using our Database Backup plugin (link below).

Translation ready with included language files for Italian, Spanish, and Portuguese.

### Advantages of Using the BigDump Restore Plugin

The BigDump Restore plugin for WordPress offers several advantages:

1. **Ease of use**: Simple installation and a user-friendly interface guide users through the restoration process.
2. **Compatibility**: Compatible with most WordPress sites, it handles databases that are too large for conventional methods.
3. **Large file support**: Capable of managing SQL files of any size, including several gigabytes.
4. **Chunked restoration**: Breaks large SQL files into smaller pieces for smoother, error-free restoration.

The BigDump Restore plugin simplifies and streamlines the restoration of large MySQL databases on WordPress sites, addressing common issues like timeouts and errors during restoration.

Visit our site for help documentation and more information.

Watch the Demo Video:
[youtube https://www.youtube.com/watch?v=vstomVnG9Qw autoplay=1]

To create a database backup file or a mysqldump, simply install our [free Database Backup plugin](https://wordpress.org/plugins/database-backup/). This plugin avoids extended inserts*, which complicate dump files with multiple-row syntax.
(*) Extended inserts include several (sometimes hundreds) VALUES lists per insert statement.

The Database Backup plugin also copies large database files to the BigDump restore folder, eliminating the need for an FTP application when restoring with BigDump, thus resolving challenges such as SQL restore hangs and restore failures on large datasets.

== Note ==
BigDump original script will fail processing large tables containing extended inserts (look above).


== Important: ==
When you restore, your current database will be erased and it is not possible undo that. Then, run a backup and download it to your local computer before proceed.


== Installation ==
1) Install via wordpress.org

2) Activate the plugin through the 'Plugins' menu in WordPress

or

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

= What are dumps in SQL? =

A database dump contains a record of the table structure and/or the data from a database and is usually in the form of a list of SQL statements ("SQL dump"). A database dump is most often used for backing up a database so that its contents can be restored in the event of data loss.

= How do I create a SQL dump? =

Install our free plugin <a href="https://wordpress.org/plugins/database-backup">Database Backup.</a>

= How do I download SQL dump? =

Install our free plugin database backup. Link above.

= How restore sql database from Contabo Storage =
Dowload to your local computer with our free plugin s3cloud
https://wordpress.org/plugins/s3cloud/

= How restore sql database from Amazon s3 bucket =
Dowload to your local computer with our free plugin s3cloud
https://wordpress.org/plugins/toolsfors3/

= How to restore very large database using BigDump on WordPress? =
The BigDump Restore plugin allows you to safely and quickly install and run the free BigDump script without any code changes, host information, or Linux command line usage. It features a friendly Graphical User Interface (GUI) for ease of use.

= What are some common challenges encountered during the restoration of large SQL databases? = 
During the restoration of large SQL databases, several issues can arise, such as **failed database restore**, **issues with large database recovery**, **unable to restore large backup**, and **database restore timeout**. These challenges often stem from the sheer size of the database and the strain it places on system resources. To address these issues effectively, consider using tools like our plugin, **BigDump**. **BigDump** specializes in managing massive SQL dumps by breaking them into smaller, more manageable segments. This approach helps avoid **failures** due to timeout errors and ensures a smoother and more reliable restoration process. By leveraging **BigDump**, you can streamline **database recovery** efforts and mitigate the risks associated with handling extensive SQL backups.



== Screenshots ==
1. Dashboard
2. Settings
3. Window Restore

== Credits ==
Credit for bigdump script to Alexey Ozerov.



== Changelog ==
2024-07-31   - Version 1.24 - Small Improvements.
2024-05-31   - Version 1.22/1.23 - Small Improvements.
2024-05-20   - Version 1.21 - Small Improvements on readme file.
2024-03-25   - Version 1.20 - Small Improvements.
2024-02-14   - Version 1.15/1.19 - Help and Navigation and translation Improvements.
2024-01-03   - Version 1.14 - Small Improvements.
2023-12-28   - Version 1.13 - Improved errors handling.
2023-11-11   - Version 1.12 - Add option to unzip bigdump.zip.
2023-11-10   - Version 1.11 - Added one more option to download bigdump.php.
2023-10-17   - Version 1.10 - Improved errors handling.
2023-09-01   - Version 1.09 - Improved errors handling.
2023-08-30   - Version 1.08 - Improved errors handling.
2023-08-29   - Version 1.06/07 - Improved errors handling.
2023-06-01   - Version 1.05 - Improved Bigdump install.
2023-03-06   - Version 1.04 - Integrated with Database Backup.
2023-03-06   - Version 1.02/1.03 - Improved Help.
2023-03-04   - Version 1.01 - Improved Help.
2023-02-28   - Version 1.00 - Initial Release.


