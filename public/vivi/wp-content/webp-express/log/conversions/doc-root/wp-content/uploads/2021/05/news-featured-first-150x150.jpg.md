WebP Express 0.20.0. Conversion triggered using bulk conversion, 2021-06-21 13:10:34

*WebP Convert 2.6.0*  ignited.
- PHP version: 7.3.28-2+ubuntu20.04.1+deb.sury.org+1
- Server software: nginx/1.21.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2021/05/news-featured-first-150x150.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2021/05/news-featured-first-150x150.jpg.webp
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
cwebp failed in 0 ms

*Trying: vips* 

**Error: ** **Required Vips extension is not available.** 
Required Vips extension is not available.
vips failed in 0 ms

*Trying: imagemagick* 

**Error: ** **exec() is not enabled.** 
exec() is not enabled.
imagemagick failed in 0 ms

*Trying: graphicsmagick* 

**Error: ** **exec() is not enabled.** 
exec() is not enabled.
graphicsmagick failed in 0 ms

*Trying: ffmpeg* 

**Error: ** **exec() is not enabled.** 
exec() is not enabled.
ffmpeg failed in 0 ms

*Trying: wpc* 

**Error: ** **Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.** 
Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.
wpc failed in 0 ms

*Trying: ewww* 

**Error: ** **Missing API key.** 
Missing API key.
ewww failed in 0 ms

*Trying: imagick* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2021/05/news-featured-first-150x150.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2021/05/news-featured-first-150x150.jpg.webp
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
Reduction: 53% (went from 8369 bytes to 3924 bytes)

Converting to lossless
Reduction: -277% (went from 8369 bytes to 31548 bytes)

Picking lossy
imagick succeeded :)

Converted image in 170 ms, reducing file size with 53% (went from 8369 bytes to 3924 bytes)
