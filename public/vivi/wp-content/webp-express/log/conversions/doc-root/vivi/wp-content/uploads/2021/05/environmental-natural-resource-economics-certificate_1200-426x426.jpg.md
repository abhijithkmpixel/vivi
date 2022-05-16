WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-05-15 09:03:12

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg.webp
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
- source: [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg.webp
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
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg
Dimension: 426 x 426
Output:    29840 bytes Y-U-V-All-PSNR 37.17 41.02 41.96   38.19 dB
           (1.32 bpp)
block count:  intra4:        675  (92.59%)
              intra16:        54  (7.41%)
              skipped:         0  (0.00%)
bytes used:  header:            134  (0.4%)
             mode-partition:   3586  (12.0%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    4388 |    6530 |    9299 |    2007 |   22224  (74.5%)
 intra16-coeffs:  |       0 |       0 |      36 |     401 |     437  (1.5%)
  chroma coeffs:  |     405 |     912 |    1619 |     494 |    3430  (11.5%)
    macroblocks:  |      10%|      19%|      46%|      25%|     729
      quantizer:  |      39 |      33 |      26 |      20 |
   filter level:  |      11 |       7 |       4 |       9 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    4793 |    7442 |   10954 |    2902 |   26091  (87.4%)

Success
Reduction: 38% (went from 47 kb to 29 kb)

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
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-426x426.jpg
Dimension: 426 x 426
Output:    148702 bytes (6.56 bpp)
Lossless-ARGB compressed size: 148702 bytes
  * Header size: 2079 bytes, image data size: 146597
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=4 transform=4 cache=10

Success
Reduction: -207% (went from 47 kb to 145 kb)

Picking lossy
cwebp succeeded :)

Converted image in 681 ms, reducing file size with 38% (went from 47 kb to 29 kb)
