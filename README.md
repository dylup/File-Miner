# File Miner
CSC-842 Cycle 5/7

## Description
- Course: CSC842 Security Tool Development
- Developer: Dylan Johnson
- Language: Python, PHP, SQL, JS, HTML
- Scope: Offensive Security/Penetration Testing

A Python script for automating the process of finding files of interest during the post-exploitation phase of a penetration test or red team exercise. Files will be submitted to a web application for the operator to more easily view.

## Capabilities
File Miner can be used to find files on a system based off file extension. It can also search for Social Security Numbers or Credit Card Numbers in files on the system. File Miner submits files of interest to a PHP web application that the operator is able to view. From there, the operator can view files on a host-by-host basis.

### Functionality
The primary function of this software is to find files that may be of interest to the operator.

## Future Work
This tool should be made a little cleaner when it comes to searching each file for SSN's or Credit Card Numbers. Future work should include cleaning up the UI of the web app, adding more funcionality to search for additional files, and making the Python script send the files themselves over the network. Finally, install scripts to setup the initial database will be developed.
