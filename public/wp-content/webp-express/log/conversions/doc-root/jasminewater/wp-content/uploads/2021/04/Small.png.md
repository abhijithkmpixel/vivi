WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-04-21 10:42:05

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/jasminewater/wp-content/uploads/2021/04/Small.png
- destination: [doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/Small.png.webp
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
- source: [doc-root]/jasminewater/wp-content/uploads/2021/04/Small.png
- destination: [doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/Small.png.webp
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
- [doc-root]/jasminewater/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15
Detecting versions of the cwebp binaries found
- Executing: /usr/local/bin/cwebp -version 2>&1. Result: version: *1.2.0*
- Executing: [doc-root]/jasminewater/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15 -version 2>&1. Result: *Exec failed*. Permission denied (user: "vijithpangath" does not have permission to execute that binary)
Binaries ordered by version number.
- /usr/local/bin/cwebp: (version: 1.2.0)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.2.0
Quality: 85. 
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/jasminewater/wp-content/uploads/2021/04/Small.png' -o '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/Small.png.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/Small.png.webp.lossy.webp'
File:      [doc-root]/jasminewater/wp-content/uploads/2021/04/Small.png
Dimension: 69 x 208 (with alpha)
Output:    1910 bytes Y-U-V-All-PSNR 43.55 46.39 46.96   44.37 dB
           (1.06 bpp)
block count:  intra4:         46  (70.77%)
              intra16:        19  (29.23%)
              skipped:        14  (21.54%)
bytes used:  header:             54  (2.8%)
             mode-partition:    261  (13.7%)
             transparency:       34 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     255 |     748 |     150 |      12 |    1165  (61.0%)
 intra16-coeffs:  |       0 |       6 |      18 |       4 |      28  (1.5%)
  chroma coeffs:  |     125 |     170 |      17 |       1 |     313  (16.4%)
    macroblocks:  |       9%|      42%|      25%|      25%|      65
      quantizer:  |      20 |      16 |      13 |       8 |
   filter level:  |       7 |       4 |       2 |       0 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |     380 |     924 |     185 |      17 |    1506  (78.8%)
Lossless-alpha compressed size: 33 bytes
  * Header size: 28 bytes, image data size: 5
  * Lossless features used: PALETTE
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   4

Success
Reduction: 90% (went from 18 kb to 2 kb)

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
- [doc-root]/jasminewater/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15
Detecting versions of the cwebp binaries found
- Executing: /usr/local/bin/cwebp -version 2>&1. Result: version: *1.2.0*
- Executing: [doc-root]/jasminewater/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15 -version 2>&1. Result: *Exec failed*. Permission denied (user: "vijithpangath" does not have permission to execute that binary)
Binaries ordered by version number.
- /usr/local/bin/cwebp: (version: 1.2.0)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.2.0
Trying to convert by executing the following command:
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/jasminewater/wp-content/uploads/2021/04/Small.png' -o '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/Small.png.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/Small.png.webp.lossless.webp'
File:      [doc-root]/jasminewater/wp-content/uploads/2021/04/Small.png
Dimension: 69 x 208
Output:    7934 bytes (4.42 bpp)
Lossless-ARGB compressed size: 7934 bytes
  * Header size: 803 bytes, image data size: 7106
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=2 transform=2 cache=8

Success
Reduction: 57% (went from 18 kb to 8 kb)

Picking lossy
cwebp succeeded :)

Converted image in 330 ms, reducing file size with 90% (went from 18 kb to 2 kb)
