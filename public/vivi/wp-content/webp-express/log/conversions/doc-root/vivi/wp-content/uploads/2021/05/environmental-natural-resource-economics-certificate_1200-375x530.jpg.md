WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-05-15 09:03:07

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg.webp
- log-call-arguments: true
- converters: (array of 10 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- encoding: "auto"
- metadata: "none"
- near-lossless: 60
- quality: 70
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg.webp
- encoding: "auto"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- near-lossless: 60
- quality: 70
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- alpha-quality: 85
- auto-filter: false
- default-quality: 75
- max-quality: 85
- preset: "none"
- size-in-percentage: null (not set)
- skip: false
- rel-path-to-precompiled-binaries: *****
- try-cwebp: true
- try-discovering-cwebp: true
------------

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (the cwebp binary was not found at path: cwebp, or it had missing library dependencies)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 1 binaries: 
- /usr/local/bin/cwebp
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Darwin)... We do.
Found 1 binaries: 
- [doc-root]/vivi/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15
Detecting versions of the cwebp binaries found
- Executing: /usr/local/bin/cwebp -version 2>&1. Result: version: *1.2.0*
- Executing: [doc-root]/vivi/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15 -version 2>&1. Result: *Exec failed*. Permission denied (user: "vijithpangath" does not have permission to execute that binary)
Binaries ordered by version number.
- /usr/local/bin/cwebp: (version: 1.2.0)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.2.0
Quality: 70. 
Consider setting quality to "auto" instead. It is generally a better idea
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg
Dimension: 375 x 530
Output:    29350 bytes Y-U-V-All-PSNR 37.58 41.43 41.95   38.57 dB
           (1.18 bpp)
block count:  intra4:        745  (91.30%)
              intra16:        71  (8.70%)
              skipped:         0  (0.00%)
bytes used:  header:            126  (0.4%)
             mode-partition:   3908  (13.3%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    3515 |    7028 |    8984 |    1544 |   21071  (71.8%)
 intra16-coeffs:  |       0 |       0 |      34 |     451 |     485  (1.7%)
  chroma coeffs:  |     304 |    1146 |    1768 |     514 |    3732  (12.7%)
    macroblocks:  |       8%|      21%|      47%|      24%|     816
      quantizer:  |      39 |      33 |      27 |      20 |
   filter level:  |      11 |       7 |       4 |      18 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    3819 |    8174 |   10786 |    2509 |   25288  (86.2%)

Success
Reduction: 41% (went from 48 kb to 29 kb)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (the cwebp binary was not found at path: cwebp, or it had missing library dependencies)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 1 binaries: 
- /usr/local/bin/cwebp
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Darwin)... We do.
Found 1 binaries: 
- [doc-root]/vivi/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15
Detecting versions of the cwebp binaries found
- Executing: /usr/local/bin/cwebp -version 2>&1. Result: version: *1.2.0*
- Executing: [doc-root]/vivi/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15 -version 2>&1. Result: *Exec failed*. Permission denied (user: "vijithpangath" does not have permission to execute that binary)
Binaries ordered by version number.
- /usr/local/bin/cwebp: (version: 1.2.0)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.2.0
Trying to convert by executing the following command:
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-375x530.jpg
Dimension: 375 x 530
Output:    156478 bytes (6.30 bpp)
Lossless-ARGB compressed size: 156478 bytes
  * Header size: 2412 bytes, image data size: 154041
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=4 transform=4 cache=10

Success
Reduction: -217% (went from 48 kb to 153 kb)

Picking lossy
cwebp succeeded :)

Converted image in 687 ms, reducing file size with 41% (went from 48 kb to 29 kb)
