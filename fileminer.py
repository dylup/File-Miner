#!/usr/bin/python3

import os
import argparse
import re
from datetime import date

# function for searching for SSN information
def searchForSSN(line):
    result = re.findall(r'(\d{3}-\d{2}-\d{4})', line)
    return result
# search for credit card info
def searchForCC(line):
    result = re.findall(r'(\d{4}-\d{4}-\d{4}-\d{4})', line)
    return result

parser = argparse.ArgumentParser(description='Search a compromised/exploited host for files of interest')
parser.add_argument('path', metavar='/path/to/directory', type=str, help='The path to start searching from')
parser.add_argument('-e', '--extensions', nargs="+", help='File extensions to search for, no commas!(i.e. .png .jpg .pdf)', required=False, default='empty')
parser.add_argument('--ssn', action='store_true', help='Search for SSN information in files (may be slow)', required=False)
parser.add_argument('--cc', action='store_true', help='Search for Credit Card information (may be slow)', required=False)
args = parser.parse_args()

directory = args.path
extensions = args.extensions
ssnSearch = args.ssn
ccSearch = args.cc

# setup counters
numberOfFiles = 0
numberOfSSNs = 0
numberOfCCs = 0
filesOfInterest = []

if ssnSearch:
    print("[!] SSN search may be slow depending on the amount and/or size of files in the directories! Use with caution!")


# recursively loop through directories under the provided directory and check each file
for subdir, dirs, files in os.walk(directory):
     for filename in files:
        filepath = subdir + os.sep + filename

        # if the user didn't specify file extensions, use hardcoded ones (pdf, xls, xlsx)
        if extensions == "empty":
            if filepath.endswith(".pdf") or filepath.endswith(".xls") or filepath.endswith(".xlsx"):
                #print("[+] File found: " + filepath)
                
                filesOfInterest += [filepath]
        else:
            if any(ext in filename for ext in extensions):
                #print ("[+] File found: " + filepath)
                filesOfInterest += [filepath]

        # if the user requested a search for SSN information, do that by reading each line of file and
        # comparing to a regex
        if ssnSearch:
            # try/accpet to avoid failing out due to permission/file encoding issues
            try:
                with open(filepath, "r") as fHandle:
                    for line in fHandle.readlines():
                        ssnList = searchForSSN(line)
                fHandle.close()

                # if SSN list contains elements, print which file and the SSN's found
                if len(ssnList) != 0:
                    print("[!] SSN found in " + filepath + ":")
                    for ssn in ssnList:
                        print("\tssn: " + ssn)

                    numberOfSSNs += len(ssnList)
                    ssnList.clear()

                    # in case the file was already added based on extension
                    if filepath not in filesOfInterest:
                        filesOfInterest += [filepath]
            except:
                x = 1

        # if the user requested a search for CC information, read each line and compare to a regex
        if ccSearch:
            try:
                with open (filepath, "r") as fHandle:
                    for line in fHandle.readlines():
                        ccList = searchForCC(line)
                    fHandle.close()

                if len(ccList) != 0:
                    print("[!] Credit Card found in " + filepath + ":")
                    for cc in ccList:
                        print("\tcc: " + cc)

                    numberOfCCs += len(ccList)
                    ccList.clear()

                    # in case the file was already added based on extension or ssn
                    if filepath not in filesOfInterest:
                        filesOfInterest += [filepath]

            except:
                x =  1

numberOfFiles = len(filesOfInterest)

print("[!] Done! Total files found:")
print("\tFiles of Interst: " + str(numberOfFiles))
print("\tSSN's: " + str(numberOfSSNs))
print("\tCredit Cards: " + str(numberOfCCs))


# output our list of intersting files 
output = "fileMiner_output_" + str(date.today()) + ".txt"
with open(output, "w") as fHandle:
    for f in filesOfInterest:
        fHandle.write(f + "\n")
fHandle.close()

print("[+] List of interesting files saved to " + output)