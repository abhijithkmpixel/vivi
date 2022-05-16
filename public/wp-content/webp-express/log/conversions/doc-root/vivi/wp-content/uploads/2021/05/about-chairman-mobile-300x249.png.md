WebP Express 0.19.1. Conversion triggered using bulk conversion, 2021-05-17 13:30:45

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/uploads/2021/05/about-chairman-mobile-300x249.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/about-chairman-mobile-300x249.png.webp
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
- source: [doc-root]/vivi/wp-content/uploads/2021/05/about-chairman-mobile-300x249.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/about-chairman-mobile-300x249.png.webp
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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/about-chairman-mobile-300x249.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/about-chairman-mobile-300x249.png.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/about-chairman-mobile-300x249.png.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/about-chairman-mobile-300x249.png
Dimension: 300 x 249 (with alpha)
Output:    7798 bytes Y-U-V-All-PSNR 44.79 45.87 45.25   45.03 dB
           (0.84 bpp)
block count:  intra4:        223  (73.36%)
              intra16:        81  (26.64%)
              skipped:        16  (5.26%)
bytes used:  header:            107  (1.4%)
             mode-partition:   1084  (13.9%)
             transparency:     1249 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     870 |    1254 |     655 |     305 |    3084  (39.5%)
 intra16-coeffs:  |       7 |      82 |      81 |     143 |     313  (4.0%)
  chroma coeffs:  |     351 |     835 |     485 |     235 |    1906  (24.4%)
    macroblocks:  |       8%|      23%|      30%|      38%|     304
      quantizer:  |      20 |      18 |      14 |       9 |
   filter level:  |       7 |       4 |      10 |       0 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    1228 |    2171 |    1221 |     683 |    5303  (68.0%)
Lossless-alpha compressed size: 1248 bytes
  * Header size: 61 bytes, image data size: 1187
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   126

Success
Reduction: 91% (went from 82 kb to 8 kb)

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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/uploads/2021/05/about-chairman-mobile-300x249.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/about-chairman-mobile-300x249.png.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/uploads/2021/05/about-chairman-mobile-300x249.png.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/uploads/2021/05/about-chairman-mobile-300x249.png
Dimension: 300 x 249
Output:    41702 bytes (4.47 bpp)
Lossless-ARGB compressed size: 41702 bytes
  * Header size: 2413 bytes, image data size: 39263
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=3 transform=3 cache=10

Success
Reduction: 51% (went from 82 kb to 41 kb)

Picking lossy
cwebp succeeded :)

Converted image in 591 ms, reducing file size with 91% (went from 82 kb to 8 kb)
