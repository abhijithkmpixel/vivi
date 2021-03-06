WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-05-14 14:11:01

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/04/Small-69x150.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/04/Small-69x150.png.webp
- log-call-arguments: true
- converters: (array of 10 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- alpha-quality: 85
- encoding: "auto"
- metadata: "none"
- near-lossless: 60
- quality: 85
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/04/Small-69x150.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/04/Small-69x150.png.webp
- alpha-quality: 85
- encoding: "auto"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- near-lossless: 60
- quality: 85
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- auto-filter: false
- default-quality: 85
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
Quality: 85. 
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/04/Small-69x150.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/04/Small-69x150.png.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/04/Small-69x150.png.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/04/Small-69x150.png
Dimension: 69 x 150 (with alpha)
Output:    1814 bytes Y-U-V-All-PSNR 43.30 45.31 45.96   43.95 dB
           (1.40 bpp)
block count:  intra4:         44  (88.00%)
              intra16:         6  (12.00%)
              skipped:         2  (4.00%)
bytes used:  header:             56  (3.1%)
             mode-partition:    235  (13.0%)
             transparency:       21 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     181 |     531 |     389 |       7 |    1108  (61.1%)
 intra16-coeffs:  |       0 |       0 |      20 |       1 |      21  (1.2%)
  chroma coeffs:  |      99 |     179 |      37 |       3 |     318  (17.5%)
    macroblocks:  |       8%|      36%|      48%|       8%|      50
      quantizer:  |      20 |      15 |      13 |       8 |
   filter level:  |       7 |       3 |       2 |       0 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |     280 |     710 |     446 |      11 |    1447  (79.8%)
Lossless-alpha compressed size: 20 bytes
  * Header size: 17 bytes, image data size: 3
  * Lossless features used: PALETTE
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   2

Success
Reduction: 89% (went from 16 kb to 2 kb)

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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/04/Small-69x150.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/04/Small-69x150.png.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/04/Small-69x150.png.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/04/Small-69x150.png
Dimension: 69 x 150
Output:    7056 bytes (5.45 bpp)
Lossless-ARGB compressed size: 7056 bytes
  * Header size: 759 bytes, image data size: 6271
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=2 transform=2 cache=8

Success
Reduction: 56% (went from 16 kb to 7 kb)

Picking lossy
cwebp succeeded :)

Converted image in 308 ms, reducing file size with 89% (went from 16 kb to 2 kb)
