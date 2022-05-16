WebP Express 0.20.1. Conversion triggered using bulk conversion, 2021-08-23 12:15:17

*WebP Convert 2.6.0*  ignited.
- PHP version: 7.3.29-1+ubuntu20.04.1+deb.sury.org+1
- Server software: nginx/1.21.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2021/05/Vivi-Drop-Filmtray-12-200-ml-288x280.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2021/05/Vivi-Drop-Filmtray-12-200-ml-288x280.jpg.webp
- log-call-arguments: true
- converters: (array of 10 items)

The following options have not been explicitly set, so using the following defaults:
- auto-limit: true
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

**Error: ** **exec() is not enabled.** 
exec() is not enabled.
cwebp failed in 1 ms

*Trying: vips* 

**Error: ** **Required Vips extension is not available.** 
Required Vips extension is not available.
vips failed in 2 ms

*Trying: imagemagick* 

**Error: ** **exec() is not enabled.** 
exec() is not enabled.
imagemagick failed in 1 ms

*Trying: graphicsmagick* 

**Error: ** **exec() is not enabled.** 
exec() is not enabled.
graphicsmagick failed in 1 ms

*Trying: ffmpeg* 

**Error: ** **exec() is not enabled.** 
exec() is not enabled.
ffmpeg failed in 1 ms

*Trying: wpc* 

**Error: ** **Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.** 
Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.
wpc failed in 1 ms

*Trying: ewww* 

**Error: ** **Missing API key.** 
Missing API key.
ewww failed in 1 ms

*Trying: imagick* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2021/05/Vivi-Drop-Filmtray-12-200-ml-288x280.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2021/05/Vivi-Drop-Filmtray-12-200-ml-288x280.jpg.webp
- encoding: "auto"
- log-call-arguments: true
- metadata: "none"
- quality: 70

The following options have not been explicitly set, so using the following defaults:
- alpha-quality: 85
- auto-limit: true
- auto-filter: false
- default-quality: 75
- low-memory: false
- max-quality: 85
- method: 6
- preset: "none"
- sharp-yuv: true
- skip: false

The following options were supplied but are ignored because they are not supported by this converter:
- near-lossless
------------

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Running auto-limit
Quality setting: 70. 
Quality of jpeg: 82. 
Auto-limit result: 70 (no limiting needed this time).
Reduction: 61% (went from 19 kb to 7 kb)

Converting to lossless
Reduction: -224% (went from 19 kb to 61 kb)

Picking lossy
imagick succeeded :)

Converted image in 177 ms, reducing file size with 61% (went from 19 kb to 7 kb)
