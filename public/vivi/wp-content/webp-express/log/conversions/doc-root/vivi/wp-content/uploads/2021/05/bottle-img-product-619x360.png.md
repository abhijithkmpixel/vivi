WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-05-14 14:17:54

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/05/bottle-img-product-619x360.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/bottle-img-product-619x360.png.webp
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
- source: [doc-root]/vivi/wp-content/uploads/2021/05/bottle-img-product-619x360.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/bottle-img-product-619x360.png.webp
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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/bottle-img-product-619x360.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/bottle-img-product-619x360.png.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/bottle-img-product-619x360.png.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/bottle-img-product-619x360.png
Dimension: 619 x 360 (with alpha)
Output:    15446 bytes Y-U-V-All-PSNR 47.10 49.18 48.95   47.66 dB
           (0.55 bpp)
block count:  intra4:        293  (32.66%)
              intra16:       604  (67.34%)
              skipped:       522  (58.19%)
bytes used:  header:            174  (1.1%)
             mode-partition:   1839  (11.9%)
             transparency:     4615 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     505 |    2485 |    2507 |     406 |    5903  (38.2%)
 intra16-coeffs:  |       0 |       0 |     121 |     274 |     395  (2.6%)
  chroma coeffs:  |     231 |    1305 |     725 |     203 |    2464  (16.0%)
    macroblocks:  |       1%|       9%|      20%|      70%|     897
      quantizer:  |      20 |      19 |      16 |      12 |
   filter level:  |       7 |       4 |       3 |       9 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |     736 |    3790 |    3353 |     883 |    8762  (56.7%)
Lossless-alpha compressed size: 4614 bytes
  * Header size: 104 bytes, image data size: 4510
  * Precision Bits: histogram=4 transform=4 cache=0
  * Palette size:   128

Success
Reduction: 88% (went from 122 kb to 15 kb)

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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/bottle-img-product-619x360.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/bottle-img-product-619x360.png.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/bottle-img-product-619x360.png.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/bottle-img-product-619x360.png
Dimension: 619 x 360
Output:    65370 bytes (2.35 bpp)
Lossless-ARGB compressed size: 65370 bytes
  * Header size: 2340 bytes, image data size: 63005
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=4 transform=4 cache=10

Success
Reduction: 48% (went from 122 kb to 64 kb)

Picking lossy
cwebp succeeded :)

Converted image in 876 ms, reducing file size with 88% (went from 122 kb to 15 kb)
