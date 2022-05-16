WebP Express 0.19.0. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2021-04-22 02:42:58

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.2
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.4.2 mod_ssl/2.2.34 OpenSSL/1.0.2o DAV/2 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/jasminewater/wp-content/uploads/2021/04/logo.png
- destination: [doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/logo.png.webp
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
- source: [doc-root]/jasminewater/wp-content/uploads/2021/04/logo.png
- destination: [doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/logo.png.webp
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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/jasminewater/wp-content/uploads/2021/04/logo.png' -o '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/logo.png.webp.lossy.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/logo.png.webp.lossy.webp'
File:      [doc-root]/jasminewater/wp-content/uploads/2021/04/logo.png
Dimension: 131 x 49 (with alpha)
Output:    2606 bytes Y-U-V-All-PSNR 47.74 72.21 63.97   49.47 dB
           (3.25 bpp)
block count:  intra4:         16  (44.44%)
              intra16:        20  (55.56%)
              skipped:         5  (13.89%)
bytes used:  header:             32  (1.2%)
             mode-partition:     72  (2.8%)
             transparency:     2194 (62.3 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |      32 |       0 |      37 |      71 |     140  (5.4%)
 intra16-coeffs:  |      83 |       6 |       0 |      22 |     111  (4.3%)
  chroma coeffs:  |       1 |       1 |       1 |       1 |       4  (0.2%)
    macroblocks:  |      58%|       3%|       6%|      33%|      36
      quantizer:  |      18 |      15 |       9 |       8 |
   filter level:  |       5 |       3 |       0 |       0 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |     116 |       7 |      38 |      94 |     255  (9.8%)
Lossless-alpha compressed size: 2193 bytes
  * Header size: 105 bytes, image data size: 2088
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   136

Success
Reduction: 59% (went from 6311 bytes to 2606 bytes)

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
nice /usr/local/bin/cwebp -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/jasminewater/wp-content/uploads/2021/04/logo.png' -o '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/logo.png.webp.lossless.webp' 2>&1 2>&1

*Output:* 
Saving file '[doc-root]/jasminewater/wp-content/webp-express/webp-images/uploads/2021/04/logo.png.webp.lossless.webp'
File:      [doc-root]/jasminewater/wp-content/uploads/2021/04/logo.png
Dimension: 131 x 49
Output:    2718 bytes (3.39 bpp)
Lossless-ARGB compressed size: 2718 bytes
  * Header size: 154 bytes, image data size: 2538
  * Lossless features used: SUBTRACT-GREEN
  * Precision Bits: histogram=2 transform=2 cache=7

Success
Reduction: 57% (went from 6311 bytes to 2718 bytes)

Picking lossy
cwebp succeeded :)

Converted image in 1064 ms, reducing file size with 59% (went from 6311 bytes to 2606 bytes)
