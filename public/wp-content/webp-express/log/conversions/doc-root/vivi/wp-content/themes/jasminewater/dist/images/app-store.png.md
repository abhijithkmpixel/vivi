WebP Express 0.19.0. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2021-05-14 14:18:54

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/vivi/wp-content/themes/jasminewater/dist/images/app-store.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/themes/jasminewater/dist/images/app-store.png.webp
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
- source: [doc-root]/vivi/wp-content/themes/jasminewater/dist/images/app-store.png
- destination: [doc-root]/vivi/wp-content/webp-express/webp-images/themes/jasminewater/dist/images/app-store.png.webp
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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/vivi/wp-content/themes/jasminewater/dist/images/app-store.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/themes/jasminewater/dist/images/app-store.png.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/themes/jasminewater/dist/images/app-store.png.webp.lossy.webp'
File:      [doc-root]/vivi/wp-content/themes/jasminewater/dist/images/app-store.png
Dimension: 134 x 40 (with alpha)
Output:    1804 bytes Y-U-V-All-PSNR 43.10 54.41 53.92   44.69 dB
           (2.69 bpp)
block count:  intra4:         21  (77.78%)
              intra16:         6  (22.22%)
              skipped:         0  (0.00%)
bytes used:  header:            164  (9.1%)
             mode-partition:    112  (6.2%)
             transparency:       93 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     129 |     318 |     570 |     333 |    1350  (74.8%)
 intra16-coeffs:  |       0 |       0 |       0 |       9 |       9  (0.5%)
  chroma coeffs:  |       1 |       1 |       1 |      17 |      20  (1.1%)
    macroblocks:  |       4%|      11%|      26%|      59%|      27
      quantizer:  |      20 |      19 |      15 |      12 |
   filter level:  |       7 |       4 |       2 |       2 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |     130 |     319 |     571 |     359 |    1379  (76.4%)
Lossless-alpha compressed size: 92 bytes
  * Header size: 37 bytes, image data size: 55
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   28

Success
Reduction: -24% (went from 1460 bytes to 1804 bytes)

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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/vivi/wp-content/themes/jasminewater/dist/images/app-store.png' -o '[doc-root]/vivi/wp-content/webp-express/webp-images/themes/jasminewater/dist/images/app-store.png.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/vivi/wp-content/webp-express/webp-images/themes/jasminewater/dist/images/app-store.png.webp.lossless.webp'
File:      [doc-root]/vivi/wp-content/themes/jasminewater/dist/images/app-store.png
Dimension: 134 x 40
Output:    1148 bytes (1.71 bpp)
Lossless-ARGB compressed size: 1148 bytes
  * Header size: 227 bytes, image data size: 895
  * Lossless features used: PALETTE
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   81

Success
Reduction: 21% (went from 1460 bytes to 1148 bytes)

Picking lossless
cwebp succeeded :)

Converted image in 1710 ms, reducing file size with 21% (went from 1460 bytes to 1148 bytes)
