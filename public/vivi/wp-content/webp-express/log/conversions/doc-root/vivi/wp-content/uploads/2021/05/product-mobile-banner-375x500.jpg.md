WebP Express 0.19.1. Conversion triggered using bulk conversion, 2021-05-19 06:06:44

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/05/product-mobile-banner-375x500.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/product-mobile-banner-375x500.jpg.webp
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
- source: [doc-root]/vivi/wp-content/uploads/2021/05/product-mobile-banner-375x500.jpg
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/product-mobile-banner-375x500.jpg.webp
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
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/product-mobile-banner-375x500.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/product-mobile-banner-375x500.jpg.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/product-mobile-banner-375x500.jpg.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/product-mobile-banner-375x500.jpg
Dimension: 375 x 500
Output:    800 bytes Y-U-V-All-PSNR 54.73 58.69 53.94   55.03 dB
           (0.03 bpp)
block count:  intra4:         39  (5.08%)
              intra16:       729  (94.92%)
              skipped:       657  (85.55%)
bytes used:  header:             31  (3.9%)
             mode-partition:    493  (61.6%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |      30 |      17 |       0 |       1 |      48  (6.0%)
 intra16-coeffs:  |       0 |       3 |       0 |      46 |      49  (6.1%)
  chroma coeffs:  |      33 |      28 |       0 |      89 |     150  (18.8%)
    macroblocks:  |       2%|       1%|       0%|      96%|     768
      quantizer:  |      39 |      39 |      34 |      27 |
   filter level:  |      11 |       8 |       6 |       4 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |      63 |      48 |       0 |     136 |     247  (30.9%)

Success
Reduction: 83% (went from 4768 bytes to 800 bytes)

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
nice /usr/local/bin/cwebp -metadata none -q 70 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/product-mobile-banner-375x500.jpg' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/product-mobile-banner-375x500.jpg.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/product-mobile-banner-375x500.jpg.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/product-mobile-banner-375x500.jpg
Dimension: 375 x 500
Output:    6088 bytes (0.26 bpp)
Lossless-ARGB compressed size: 6088 bytes
  * Header size: 558 bytes, image data size: 5505
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=4 transform=4 cache=10

Success
Reduction: -28% (went from 4768 bytes to 6088 bytes)

Picking lossy
cwebp succeeded :)

Converted image in 863 ms, reducing file size with 83% (went from 4768 bytes to 800 bytes)
