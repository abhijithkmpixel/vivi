WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-05-15 09:03:03

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg.webp
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
- source: [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg.webp
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
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg
Dimension: 150 x 150
Output:    5600 bytes Y-U-V-All-PSNR 35.63 40.46 40.83   36.76 dB
           (1.99 bpp)
block count:  intra4:         97  (97.00%)
              intra16:         3  (3.00%)
              skipped:         0  (0.00%)
bytes used:  header:             93  (1.7%)
             mode-partition:    522  (9.3%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    1788 |    1453 |     844 |     288 |    4373  (78.1%)
 intra16-coeffs:  |       0 |       0 |       0 |      29 |      29  (0.5%)
  chroma coeffs:  |     210 |     158 |     117 |      69 |     554  (9.9%)
    macroblocks:  |      30%|      29%|      22%|      19%|     100
      quantizer:  |      38 |      29 |      23 |      16 |
   filter level:  |      11 |       6 |       4 |       2 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    1998 |    1611 |     961 |     386 |    4956  (88.5%)

Success
Reduction: 35% (went from 8639 bytes to 5600 bytes)

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
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/environmental-natural-resource-economics-certificate_1200-150x150.jpg
Dimension: 150 x 150
Output:    23032 bytes (8.19 bpp)
Lossless-ARGB compressed size: 23032 bytes
  * Header size: 1443 bytes, image data size: 21563
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=2 transform=2 cache=0

Success
Reduction: -167% (went from 8639 bytes to 23032 bytes)

Picking lossy
cwebp succeeded :)

Converted image in 362 ms, reducing file size with 35% (went from 8639 bytes to 5600 bytes)
