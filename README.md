# File Miner
CSC-842 Cycle 5

## Description
- Course: CSC842 Security Tool Development
- Developer: Dylan Johnson
- Language: Python
- Scope: Offensive Security/Penetration Testing

A Python script for automating the process of finding files of interest during the post-exploitation phase of a penetration test or red team exercise. 

## Capabilities
File Miner can be used to find files on a system based off file extension. It can also search for Social Security Numbers or Credit Card Numbers in files on the system.

### Functionality
The primary function of this software is to find files that may be of interest to the operator.

## Future Work
This tool should be made a little cleaner when it comes to searching each file for SSN's or Credit Card Numbers. Future work should also include sending the results over the network, possibly via HTTP requests, to a server owned by the operator, with. A backend system could be setup to organize by machine. 
