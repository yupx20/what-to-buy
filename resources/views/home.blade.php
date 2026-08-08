<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */ @layer properties{@supports (((-webkit-hyphens:none)) and (not (margin-trim:inline))) or ((-moz-orient:inline) and (not (color:rgb(from red r g b)))){*,:before,:after,::backdrop{--tw-translate-x:0;--tw-translate-y:0;--tw-translate-z:0;--tw-rotate-x:initial;--tw-rotate-y:initial;--tw-rotate-z:initial;--tw-skew-x:initial;--tw-skew-y:initial;--tw-space-x-reverse:0;--tw-border-style:solid;--tw-leading:initial;--tw-font-weight:initial;--tw-tracking:initial;--tw-shadow:0 0 #0000;--tw-shadow-color:initial;--tw-shadow-alpha:100%;--tw-inset-shadow:0 0 #0000;--tw-inset-shadow-color:initial;--tw-inset-shadow-alpha:100%;--tw-ring-color:initial;--tw-ring-shadow:0 0 #0000;--tw-inset-ring-color:initial;--tw-inset-ring-shadow:0 0 #0000;--tw-ring-inset:initial;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-offset-shadow:0 0 #0000;--tw-blur:initial;--tw-brightness:initial;--tw-contrast:initial;--tw-grayscale:initial;--tw-hue-rotate:initial;--tw-invert:initial;--tw-opacity:initial;--tw-saturate:initial;--tw-sepia:initial;--tw-drop-shadow:initial;--tw-drop-shadow-color:initial;--tw-drop-shadow-alpha:100%;--tw-drop-shadow-size:initial;--tw-duration:initial;--tw-ease:initial;--tw-content:""}}}@layer theme{:root,:host{--font-sans:"Instrument Sans", ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";--font-serif:ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;--font-mono:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;--color-red-50:oklch(97.1% .013 17.38);--color-red-100:oklch(93.6% .032 17.717);--color-red-200:oklch(88.5% .062 18.334);--color-red-300:oklch(80.8% .114 19.571);--color-red-400:oklch(70.4% .191 22.216);--color-red-500:oklch(63.7% .237 25.331);--color-red-600:oklch(57.7% .245 27.325);--color-red-700:oklch(50.5% .213 27.518);--color-red-800:oklch(44.4% .177 26.899);--color-red-900:oklch(39.6% .141 25.723);--color-red-950:oklch(25.8% .092 26.042);--color-orange-50:oklch(98% .016 73.684);--color-orange-100:oklch(95.4% .038 75.164);--color-orange-200:oklch(90.1% .076 70.697);--color-orange-300:oklch(83.7% .128 66.29);--color-orange-400:oklch(75% .183 55.934);--color-orange-500:oklch(70.5% .213 47.604);--color-orange-600:oklch(64.6% .222 41.116);--color-orange-700:oklch(55.3% .195 38.402);--color-orange-800:oklch(47% .157 37.304);--color-orange-900:oklch(40.8% .123 38.172);--color-orange-950:oklch(26.6% .079 36.259);--color-amber-50:oklch(98.7% .022 95.277);--color-amber-100:oklch(96.2% .059 95.617);--color-amber-200:oklch(92.4% .12 95.746);--color-amber-300:oklch(87.9% .169 91.605);--color-amber-400:oklch(82.8% .189 84.429);--color-amber-500:oklch(76.9% .188 70.08);--color-amber-600:oklch(66.6% .179 58.318);--color-amber-700:oklch(55.5% .163 48.998);--color-amber-800:oklch(47.3% .137 46.201);--color-amber-900:oklch(41.4% .112 45.904);--color-amber-950:oklch(27.9% .077 45.635);--color-yellow-50:oklch(98.7% .026 102.212);--color-yellow-100:oklch(97.3% .071 103.193);--color-yellow-200:oklch(94.5% .129 101.54);--color-yellow-300:oklch(90.5% .182 98.111);--color-yellow-400:oklch(85.2% .199 91.936);--color-yellow-500:oklch(79.5% .184 86.047);--color-yellow-600:oklch(68.1% .162 75.834);--color-yellow-700:oklch(55.4% .135 66.442);--color-yellow-800:oklch(47.6% .114 61.907);--color-yellow-900:oklch(42.1% .095 57.708);--color-yellow-950:oklch(28.6% .066 53.813);--color-lime-50:oklch(98.6% .031 120.757);--color-lime-100:oklch(96.7% .067 122.328);--color-lime-200:oklch(93.8% .127 124.321);--color-lime-300:oklch(89.7% .196 126.665);--color-lime-400:oklch(84.1% .238 128.85);--color-lime-500:oklch(76.8% .233 130.85);--color-lime-600:oklch(64.8% .2 131.684);--color-lime-700:oklch(53.2% .157 131.589);--color-lime-800:oklch(45.3% .124 130.933);--color-lime-900:oklch(40.5% .101 131.063);--color-lime-950:oklch(27.4% .072 132.109);--color-green-50:oklch(98.2% .018 155.826);--color-green-100:oklch(96.2% .044 156.743);--color-green-200:oklch(92.5% .084 155.995);--color-green-300:oklch(87.1% .15 154.449);--color-green-400:oklch(79.2% .209 151.711);--color-green-500:oklch(72.3% .219 149.579);--color-green-600:oklch(62.7% .194 149.214);--color-green-700:oklch(52.7% .154 150.069);--color-green-800:oklch(44.8% .119 151.328);--color-green-900:oklch(39.3% .095 152.535);--color-green-950:oklch(26.6% .065 152.934);--color-emerald-50:oklch(97.9% .021 166.113);--color-emerald-100:oklch(95% .052 163.051);--color-emerald-200:oklch(90.5% .093 164.15);--color-emerald-300:oklch(84.5% .143 164.978);--color-emerald-400:oklch(76.5% .177 163.223);--color-emerald-500:oklch(69.6% .17 162.48);--color-emerald-600:oklch(59.6% .145 163.225);--color-emerald-700:oklch(50.8% .118 165.612);--color-emerald-800:oklch(43.2% .095 166.913);--color-emerald-900:oklch(37.8% .077 168.94);--color-emerald-950:oklch(26.2% .051 172.552);--color-teal-50:oklch(98.4% .014 180.72);--color-teal-100:oklch(95.3% .051 180.801);--color-teal-200:oklch(91% .096 180.426);--color-teal-300:oklch(85.5% .138 181.071);--color-teal-400:oklch(77.7% .152 181.912);--color-teal-500:oklch(70.4% .14 182.503);--color-teal-600:oklch(60% .118 184.704);--color-teal-700:oklch(51.1% .096 186.391);--color-teal-800:oklch(43.7% .078 188.216);--color-teal-900:oklch(38.6% .063 188.416);--color-teal-950:oklch(27.7% .046 192.524);--color-cyan-50:oklch(98.4% .019 200.873);--color-cyan-100:oklch(95.6% .045 203.388);--color-cyan-200:oklch(91.7% .08 205.041);--color-cyan-300:oklch(86.5% .127 207.078);--color-cyan-400:oklch(78.9% .154 211.53);--color-cyan-500:oklch(71.5% .143 215.221);--color-cyan-600:oklch(60.9% .126 221.723);--color-cyan-700:oklch(52% .105 223.128);--color-cyan-800:oklch(45% .085 224.283);--color-cyan-900:oklch(39.8% .07 227.392);--color-cyan-950:oklch(30.2% .056 229.695);--color-sky-50:oklch(97.7% .013 236.62);--color-sky-100:oklch(95.1% .026 236.824);--color-sky-200:oklch(90.1% .058 230.902);--color-sky-300:oklch(82.8% .111 230.318);--color-sky-400:oklch(74.6% .16 232.661);--color-sky-500:oklch(68.5% .169 237.323);--color-sky-600:oklch(58.8% .158 241.966);--color-sky-700:oklch(50% .134 242.749);--color-sky-800:oklch(44.3% .11 240.79);--color-sky-900:oklch(39.1% .09 240.876);--color-sky-950:oklch(29.3% .066 243.157);--color-blue-50:oklch(97% .014 254.604);--color-blue-100:oklch(93.2% .032 255.585);--color-blue-200:oklch(88.2% .059 254.128);--color-blue-300:oklch(80.9% .105 251.813);--color-blue-400:oklch(70.7% .165 254.624);--color-blue-500:oklch(62.3% .214 259.815);--color-blue-600:oklch(54.6% .245 262.881);--color-blue-700:oklch(48.8% .243 264.376);--color-blue-800:oklch(42.4% .199 265.638);--color-blue-900:oklch(37.9% .146 265.522);--color-blue-950:oklch(28.2% .091 267.935);--color-indigo-50:oklch(96.2% .018 272.314);--color-indigo-100:oklch(93% .034 272.788);--color-indigo-200:oklch(87% .065 274.039);--color-indigo-300:oklch(78.5% .115 274.713);--color-indigo-400:oklch(67.3% .182 276.935);--color-indigo-500:oklch(58.5% .233 277.117);--color-indigo-600:oklch(51.1% .262 276.966);--color-indigo-700:oklch(45.7% .24 277.023);--color-indigo-800:oklch(39.8% .195 277.366);--color-indigo-900:oklch(35.9% .144 278.697);--color-indigo-950:oklch(25.7% .09 281.288);--color-violet-50:oklch(96.9% .016 293.756);--color-violet-100:oklch(94.3% .029 294.588);--color-violet-200:oklch(89.4% .057 293.283);--color-violet-300:oklch(81.1% .111 293.571);--color-violet-400:oklch(70.2% .183 293.541);--color-violet-500:oklch(60.6% .25 292.717);--color-violet-600:oklch(54.1% .281 293.009);--color-violet-700:oklch(49.1% .27 292.581);--color-violet-800:oklch(43.2% .232 292.759);--color-violet-900:oklch(38% .189 293.745);--color-violet-950:oklch(28.3% .141 291.089);--color-purple-50:oklch(97.7% .014 308.299);--color-purple-100:oklch(94.6% .033 307.174);--color-purple-200:oklch(90.2% .063 306.703);--color-purple-300:oklch(82.7% .119 306.383);--color-purple-400:oklch(71.4% .203 305.504);--color-purple-500:oklch(62.7% .265 303.9);--color-purple-600:oklch(55.8% .288 302.321);--color-purple-700:oklch(49.6% .265 301.924);--color-purple-800:oklch(43.8% .218 303.724);--color-purple-900:oklch(38.1% .176 304.987);--color-purple-950:oklch(29.1% .149 302.717);--color-fuchsia-50:oklch(97.7% .017 320.058);--color-fuchsia-100:oklch(95.2% .037 318.852);--color-fuchsia-200:oklch(90.3% .076 319.62);--color-fuchsia-300:oklch(83.3% .145 321.434);--color-fuchsia-400:oklch(74% .238 322.16);--color-fuchsia-500:oklch(66.7% .295 322.15);--color-fuchsia-600:oklch(59.1% .293 322.896);--color-fuchsia-700:oklch(51.8% .253 323.949);--color-fuchsia-800:oklch(45.2% .211 324.591);--color-fuchsia-900:oklch(40.1% .17 325.612);--color-fuchsia-950:oklch(29.3% .136 325.661);--color-pink-50:oklch(97.1% .014 343.198);--color-pink-100:oklch(94.8% .028 342.258);--color-pink-200:oklch(89.9% .061 343.231);--color-pink-300:oklch(82.3% .12 346.018);--color-pink-400:oklch(71.8% .202 349.761);--color-pink-500:oklch(65.6% .241 354.308);--color-pink-600:oklch(59.2% .249 .584);--color-pink-700:oklch(52.5% .223 3.958);--color-pink-800:oklch(45.9% .187 3.815);--color-pink-900:oklch(40.8% .153 2.432);--color-pink-950:oklch(28.4% .109 3.907);--color-rose-50:oklch(96.9% .015 12.422);--color-rose-100:oklch(94.1% .03 12.58);--color-rose-200:oklch(89.2% .058 10.001);--color-rose-300:oklch(81% .117 11.638);--color-rose-400:oklch(71.2% .194 13.428);--color-rose-500:oklch(64.5% .246 16.439);--color-rose-600:oklch(58.6% .253 17.585);--color-rose-700:oklch(51.4% .222 16.935);--color-rose-800:oklch(45.5% .188 13.697);--color-rose-900:oklch(41% .159 10.272);--color-rose-950:oklch(27.1% .105 12.094);--color-slate-50:oklch(98.4% .003 247.858);--color-slate-100:oklch(96.8% .007 247.896);--color-slate-200:oklch(92.9% .013 255.508);--color-slate-300:oklch(86.9% .022 252.894);--color-slate-400:oklch(70.4% .04 256.788);--color-slate-500:oklch(55.4% .046 257.417);--color-slate-600:oklch(44.6% .043 257.281);--color-slate-700:oklch(37.2% .044 257.287);--color-slate-800:oklch(27.9% .041 260.031);--color-slate-900:oklch(20.8% .042 265.755);--color-slate-950:oklch(12.9% .042 264.695);--color-gray-50:oklch(98.5% .002 247.839);--color-gray-100:oklch(96.7% .003 264.542);--color-gray-200:oklch(92.8% .006 264.531);--color-gray-300:oklch(87.2% .01 258.338);--color-gray-400:oklch(70.7% .022 261.325);--color-gray-500:oklch(55.1% .027 264.364);--color-gray-600:oklch(44.6% .03 256.802);--color-gray-700:oklch(37.3% .034 259.733);--color-gray-800:oklch(27.8% .033 256.848);--color-gray-900:oklch(21% .034 264.665);--color-gray-950:oklch(13% .028 261.692);--color-zinc-50:oklch(98.5% 0 0);--color-zinc-100:oklch(96.7% .001 286.375);--color-zinc-200:oklch(92% .004 286.32);--color-zinc-300:oklch(87.1% .006 286.286);--color-zinc-400:oklch(70.5% .015 286.067);--color-zinc-500:oklch(55.2% .016 285.938);--color-zinc-600:oklch(44.2% .017 285.786);--color-zinc-700:oklch(37% .013 285.805);--color-zinc-800:oklch(27.4% .006 286.033);--color-zinc-900:oklch(21% .006 285.885);--color-zinc-950:oklch(14.1% .005 285.823);--color-neutral-50:oklch(98.5% 0 0);--color-neutral-100:oklch(97% 0 0);--color-neutral-200:oklch(92.2% 0 0);--color-neutral-300:oklch(87% 0 0);--color-neutral-400:oklch(70.8% 0 0);--color-neutral-500:oklch(55.6% 0 0);--color-neutral-600:oklch(43.9% 0 0);--color-neutral-700:oklch(37.1% 0 0);--color-neutral-800:oklch(26.9% 0 0);--color-neutral-900:oklch(20.5% 0 0);--color-neutral-950:oklch(14.5% 0 0);--color-stone-50:oklch(98.5% .001 106.423);--color-stone-100:oklch(97% .001 106.424);--color-stone-200:oklch(92.3% .003 48.717);--color-stone-300:oklch(86.9% .005 56.366);--color-stone-400:oklch(70.9% .01 56.259);--color-stone-500:oklch(55.3% .013 58.071);--color-stone-600:oklch(44.4% .011 73.639);--color-stone-700:oklch(37.4% .01 67.558);--color-stone-800:oklch(26.8% .007 34.298);--color-stone-900:oklch(21.6% .006 56.043);--color-stone-950:oklch(14.7% .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--breakpoint-sm:40rem;--breakpoint-md:48rem;--breakpoint-lg:64rem;--breakpoint-xl:80rem;--breakpoint-2xl:96rem;--container-3xs:16rem;--container-2xs:18rem;--container-xs:20rem;--container-sm:24rem;--container-md:28rem;--container-lg:32rem;--container-xl:36rem;--container-2xl:42rem;--container-3xl:48rem;--container-4xl:56rem;--container-5xl:64rem;--container-6xl:72rem;--container-7xl:80rem;--text-xs:.75rem;--text-xs--line-height:calc(1 / .75);--text-sm:.875rem;--text-sm--line-height:calc(1.25 / .875);--text-base:1rem;--text-base--line-height: 1.5 ;--text-lg:1.125rem;--text-lg--line-height:calc(1.75 / 1.125);--text-xl:1.25rem;--text-xl--line-height:calc(1.75 / 1.25);--text-2xl:1.5rem;--text-2xl--line-height:calc(2 / 1.5);--text-3xl:1.875rem;--text-3xl--line-height: 1.2 ;--text-4xl:2.25rem;--text-4xl--line-height:calc(2.5 / 2.25);--text-5xl:3rem;--text-5xl--line-height:1;--text-6xl:3.75rem;--text-6xl--line-height:1;--text-7xl:4.5rem;--text-7xl--line-height:1;--text-8xl:6rem;--text-8xl--line-height:1;--text-9xl:8rem;--text-9xl--line-height:1;--font-weight-thin:100;--font-weight-extralight:200;--font-weight-light:300;--font-weight-normal:400;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--font-weight-extrabold:800;--font-weight-black:900;--tracking-tighter:-.05em;--tracking-tight:-.025em;--tracking-normal:0em;--tracking-wide:.025em;--tracking-wider:.05em;--tracking-widest:.1em;--leading-tight:1.25;--leading-snug:1.375;--leading-normal:1.5;--leading-relaxed:1.625;--leading-loose:2;--radius-xs:.125rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--radius-2xl:1rem;--radius-3xl:1.5rem;--radius-4xl:2rem;--shadow-2xs:0 1px #0000000d;--shadow-xs:0 1px 2px 0 #0000000d;--shadow-sm:0 1px 3px 0 #0000001a, 0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a, 0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a, 0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a, 0 8px 10px -6px #0000001a;--shadow-2xl:0 25px 50px -12px #00000040;--inset-shadow-2xs:inset 0 1px #0000000d;--inset-shadow-xs:inset 0 1px 1px #0000000d;--inset-shadow-sm:inset 0 2px 4px #0000000d;--drop-shadow-xs:0 1px 1px #0000000d;--drop-shadow-sm:0 1px 2px #00000026;--drop-shadow-md:0 3px 3px #0000001f;--drop-shadow-lg:0 4px 4px #00000026;--drop-shadow-xl:0 9px 7px #0000001a;--drop-shadow-2xl:0 25px 25px #00000026;--ease-in:cubic-bezier(.4, 0, 1, 1);--ease-out:cubic-bezier(0, 0, .2, 1);--ease-in-out:cubic-bezier(.4, 0, .2, 1);--animate-spin:spin 1s linear infinite;--animate-ping:ping 1s cubic-bezier(0, 0, .2, 1) infinite;--animate-pulse:pulse 2s cubic-bezier(.4, 0, .6, 1) infinite;--animate-bounce:bounce 1s infinite;--blur-xs:4px;--blur-sm:8px;--blur-md:12px;--blur-lg:16px;--blur-xl:24px;--blur-2xl:40px;--blur-3xl:64px;--perspective-dramatic:100px;--perspective-near:300px;--perspective-normal:500px;--perspective-midrange:800px;--perspective-distant:1200px;--aspect-video:16 / 9;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4, 0, .2, 1);--default-font-family:var(--font-sans);--default-mono-font-family:var(--font-mono)}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}::file-selector-button{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji");font-feature-settings:var(--default-font-feature-settings,normal);font-variation-settings:var(--default-font-variation-settings,normal);-webkit-tap-highlight-color:transparent}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:var(--default-mono-font-family,ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace);font-feature-settings:var(--default-mono-font-feature-settings,normal);font-variation-settings:var(--default-mono-font-variation-settings,normal);font-size:1em}small{font-size:80%}sub,sup{vertical-align:baseline;font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}:-moz-focusring{outline:auto}progress{vertical-align:baseline}summary{display:list-item}ol,ul,menu{list-style:none}img,svg,video,canvas,audio,iframe,embed,object{vertical-align:middle;display:block}img,video{max-width:100%;height:auto}button,input,select,optgroup,textarea{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}::file-selector-button{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}:where(select:is([multiple],[size])) optgroup{font-weight:bolder}:where(select:is([multiple],[size])) optgroup option{padding-inline-start:20px}::file-selector-button{margin-inline-end:4px}::placeholder{opacity:1}@supports (not ((-webkit-appearance:-apple-pay-button))) or (contain-intrinsic-size:1px){::placeholder{color:currentColor}@supports (color:color-mix(in lab,red,red)){::placeholder{color:color-mix(in oklab,currentcolor 50%,transparent)}}}textarea{resize:vertical}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-date-and-time-value{min-height:1lh;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-datetime-edit{padding-block:0}::-webkit-datetime-edit-year-field{padding-block:0}::-webkit-datetime-edit-month-field{padding-block:0}::-webkit-datetime-edit-day-field{padding-block:0}::-webkit-datetime-edit-hour-field{padding-block:0}::-webkit-datetime-edit-minute-field{padding-block:0}::-webkit-datetime-edit-second-field{padding-block:0}::-webkit-datetime-edit-millisecond-field{padding-block:0}::-webkit-datetime-edit-meridiem-field{padding-block:0}::-webkit-calendar-picker-indicator{line-height:1}:-moz-ui-invalid{box-shadow:none}button,input:where([type=button],[type=reset],[type=submit]){appearance:button}::file-selector-button{appearance:button}::-webkit-inner-spin-button{height:auto}::-webkit-outer-spin-button{height:auto}[hidden]:where(:not([hidden=until-found])){display:none!important}}@layer components;@layer utilities{.absolute{position:absolute}.fixed{position:fixed}.relative{position:relative}.static{position:static}.inset-0{inset:calc(var(--spacing) * 0)}.start{inset-inline-start:var(--spacing)}.top-0{top:calc(var(--spacing) * 0)}.right-0{right:calc(var(--spacing) * 0)}.container{width:100%}@media(min-width:40rem){.container{max-width:40rem}}@media(min-width:48rem){.container{max-width:48rem}}@media(min-width:64rem){.container{max-width:64rem}}@media(min-width:80rem){.container{max-width:80rem}}@media(min-width:96rem){.container{max-width:96rem}}.mx-auto{margin-inline:auto}.-mt-\[6\.6rem\]{margin-top:-6.6rem}.-mt-px{margin-top:-1px}.mt-2{margin-top:calc(var(--spacing) * 2)}.mt-4{margin-top:calc(var(--spacing) * 4)}.mt-6{margin-top:calc(var(--spacing) * 6)}.mt-8{margin-top:calc(var(--spacing) * 8)}.mr-2{margin-right:calc(var(--spacing) * 2)}.-mb-px{margin-bottom:-1px}.mb-1{margin-bottom:calc(var(--spacing) * 1)}.mb-2{margin-bottom:calc(var(--spacing) * 2)}.mb-4{margin-bottom:calc(var(--spacing) * 4)}.mb-6{margin-bottom:calc(var(--spacing) * 6)}.-ml-8{margin-left:calc(var(--spacing) * -8)}.-ml-px{margin-left:-1px}.ml-1{margin-left:calc(var(--spacing) * 1)}.ml-2{margin-left:calc(var(--spacing) * 2)}.ml-4{margin-left:calc(var(--spacing) * 4)}.ml-12{margin-left:calc(var(--spacing) * 12)}.contents{display:contents}.flex{display:flex}.grid{display:grid}.hidden{display:none}.inline-block{display:inline-block}.inline-flex{display:inline-flex}.table{display:table}.aspect-\[335\/364\]{aspect-ratio:335/364}.h-1{height:calc(var(--spacing) * 1)}.h-1\.5{height:calc(var(--spacing) * 1.5)}.h-2{height:calc(var(--spacing) * 2)}.h-2\.5{height:calc(var(--spacing) * 2.5)}.h-3{height:calc(var(--spacing) * 3)}.h-3\.5{height:calc(var(--spacing) * 3.5)}.h-5{height:calc(var(--spacing) * 5)}.h-8{height:calc(var(--spacing) * 8)}.h-14{height:calc(var(--spacing) * 14)}.h-14\.5{height:calc(var(--spacing) * 14.5)}.h-16{height:calc(var(--spacing) * 16)}.min-h-screen{min-height:100vh}.w-1{width:calc(var(--spacing) * 1)}.w-1\.5{width:calc(var(--spacing) * 1.5)}.w-2{width:calc(var(--spacing) * 2)}.w-2\.5{width:calc(var(--spacing) * 2.5)}.w-3{width:calc(var(--spacing) * 3)}.w-3\.5{width:calc(var(--spacing) * 3.5)}.w-5{width:calc(var(--spacing) * 5)}.w-8{width:calc(var(--spacing) * 8)}.w-\[438px\]{width:438px}.w-auto{width:auto}.w-full{width:100%}.max-w-6xl{max-width:var(--container-6xl)}.max-w-\[335px\]{max-width:335px}.max-w-none{max-width:none}.max-w-xl{max-width:var(--container-xl)}.flex-1{flex:1}.shrink-0{flex-shrink:0}.translate-y-0{--tw-translate-y:calc(var(--spacing) * 0);translate:var(--tw-translate-x) var(--tw-translate-y)}.transform{transform:var(--tw-rotate-x,) var(--tw-rotate-y,) var(--tw-rotate-z,) var(--tw-skew-x,) var(--tw-skew-y,)}.cursor-default{cursor:default}.cursor-not-allowed{cursor:not-allowed}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}.flex-col{flex-direction:column}.flex-col-reverse{flex-direction:column-reverse}.items-center{align-items:center}.justify-between{justify-content:space-between}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.justify-items-center{justify-items:center}.gap-2{gap:calc(var(--spacing) * 2)}.gap-3{gap:calc(var(--spacing) * 3)}.gap-4{gap:calc(var(--spacing) * 4)}:where(.space-x-1>:not(:last-child)){--tw-space-x-reverse:0;margin-inline-start:calc(calc(var(--spacing) * 1) * var(--tw-space-x-reverse));margin-inline-end:calc(calc(var(--spacing) * 1) * calc(1 - var(--tw-space-x-reverse)))}.overflow-hidden{overflow:hidden}.rounded-full{border-radius:3.40282e38px}.rounded-md{border-radius:var(--radius-md)}.rounded-sm{border-radius:var(--radius-sm)}.rounded-t-lg{border-top-left-radius:var(--radius-lg);border-top-right-radius:var(--radius-lg)}.rounded-l-md{border-top-left-radius:var(--radius-md);border-bottom-left-radius:var(--radius-md)}.rounded-r-md{border-top-right-radius:var(--radius-md);border-bottom-right-radius:var(--radius-md)}.rounded-br-lg{border-bottom-right-radius:var(--radius-lg)}.rounded-bl-lg{border-bottom-left-radius:var(--radius-lg)}.border{border-style:var(--tw-border-style);border-width:1px}.border-t{border-top-style:var(--tw-border-style);border-top-width:1px}.border-r{border-right-style:var(--tw-border-style);border-right-width:1px}.border-\[\#19140035\]{border-color:#19140035}.border-\[\#e3e3e0\]{border-color:#e3e3e0}.border-black{border-color:var(--color-black)}.border-gray-200{border-color:var(--color-gray-200)}.border-gray-300{border-color:var(--color-gray-300)}.border-gray-400{border-color:var(--color-gray-400)}.border-transparent{border-color:#0000}.bg-\[\#1b1b18\]{background-color:#1b1b18}.bg-\[\#FDFDFC\]{background-color:#fdfdfc}.bg-\[\#dbdbd7\]{background-color:#dbdbd7}.bg-\[\#fff2f2\]{background-color:#fff2f2}.bg-gray-100{background-color:var(--color-gray-100)}.bg-gray-200{background-color:var(--color-gray-200)}.bg-white{background-color:var(--color-white)}.p-6{padding:calc(var(--spacing) * 6)}.px-2{padding-inline:calc(var(--spacing) * 2)}.px-4{padding-inline:calc(var(--spacing) * 4)}.px-5{padding-inline:calc(var(--spacing) * 5)}.px-6{padding-inline:calc(var(--spacing) * 6)}.py-1{padding-block:calc(var(--spacing) * 1)}.py-1\.5{padding-block:calc(var(--spacing) * 1.5)}.py-2{padding-block:calc(var(--spacing) * 2)}.py-4{padding-block:calc(var(--spacing) * 4)}.pt-8{padding-top:calc(var(--spacing) * 8)}.pb-6{padding-bottom:calc(var(--spacing) * 6)}.pb-12{padding-bottom:calc(var(--spacing) * 12)}.text-center{text-align:center}.text-lg{font-size:var(--text-lg);line-height:var(--tw-leading,var(--text-lg--line-height))}.text-sm{font-size:var(--text-sm);line-height:var(--tw-leading,var(--text-sm--line-height))}.text-\[13px\]{font-size:13px}.leading-5{--tw-leading:calc(var(--spacing) * 5);line-height:calc(var(--spacing) * 5)}.leading-7{--tw-leading:calc(var(--spacing) * 7);line-height:calc(var(--spacing) * 7)}.leading-\[20px\]{--tw-leading:20px;line-height:20px}.leading-normal{--tw-leading:var(--leading-normal);line-height:var(--leading-normal)}.font-medium{--tw-font-weight:var(--font-weight-medium);font-weight:var(--font-weight-medium)}.font-semibold{--tw-font-weight:var(--font-weight-semibold);font-weight:var(--font-weight-semibold)}.tracking-wider{--tw-tracking:var(--tracking-wider);letter-spacing:var(--tracking-wider)}.text-\[\#1B1B18\],.text-\[\#1b1b18\]{color:#1b1b18}.text-\[\#706f6c\]{color:#706f6c}.text-\[\#F3BEC7\]{color:#f3bec7}.text-\[\#F8B803\]{color:#f8b803}.text-\[\#F53003\],.text-\[\#f53003\]{color:#f53003}.text-gray-200{color:var(--color-gray-200)}.text-gray-300{color:var(--color-gray-300)}.text-gray-400{color:var(--color-gray-400)}.text-gray-500{color:var(--color-gray-500)}.text-gray-600{color:var(--color-gray-600)}.text-gray-700{color:var(--color-gray-700)}.text-gray-800{color:var(--color-gray-800)}.text-gray-900{color:var(--color-gray-900)}.text-white{color:var(--color-white)}.uppercase{text-transform:uppercase}.underline{text-decoration-line:underline}.underline-offset-4{text-underline-offset:4px}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.opacity-100{opacity:1}.mix-blend-color{mix-blend-mode:color}.mix-blend-darken{mix-blend-mode:darken}.mix-blend-hard-light{mix-blend-mode:hard-light}.mix-blend-multiply{mix-blend-mode:multiply}.shadow{--tw-shadow:0 1px 3px 0 var(--tw-shadow-color,#0000001a), 0 1px 2px -1px var(--tw-shadow-color,#0000001a);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[0px_0px_1px_0px_rgba\(0\,0\,0\,0\.03\)\,0px_1px_2px_0px_rgba\(0\,0\,0\,0\.06\)\]{--tw-shadow:0px 0px 1px 0px var(--tw-shadow-color,#00000008), 0px 1px 2px 0px var(--tw-shadow-color,#0000000f);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#1a1a0029);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-sm{--tw-shadow:0 1px 3px 0 var(--tw-shadow-color,#0000001a), 0 1px 2px -1px var(--tw-shadow-color,#0000001a);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.ring-gray-300{--tw-ring-color:var(--color-gray-300)}.filter{filter:var(--tw-blur,) var(--tw-brightness,) var(--tw-contrast,) var(--tw-grayscale,) var(--tw-hue-rotate,) var(--tw-invert,) var(--tw-saturate,) var(--tw-sepia,) var(--tw-drop-shadow,)}.transition{transition-property:color,background-color,border-color,outline-color,text-decoration-color,fill,stroke,--tw-gradient-from,--tw-gradient-via,--tw-gradient-to,opacity,box-shadow,transform,translate,scale,rotate,filter,-webkit-backdrop-filter,backdrop-filter,display,content-visibility,overlay,pointer-events;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-all{transition-property:all;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-opacity{transition-property:opacity;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.delay-200{transition-delay:.2s}.delay-300{transition-delay:.3s}.delay-400{transition-delay:.4s}.duration-150{--tw-duration:.15s;transition-duration:.15s}.duration-750{--tw-duration:.75s;transition-duration:.75s}.ease-in-out{--tw-ease:var(--ease-in-out);transition-timing-function:var(--ease-in-out)}.\[--stroke-color\:\#1B1B18\]{--stroke-color:#1b1b18}.not-has-\[nav\]\:hidden:not(:has(:is(nav))){display:none}.before\:absolute:before{content:var(--tw-content);position:absolute}.before\:top-0:before{content:var(--tw-content);top:calc(var(--spacing) * 0)}.before\:top-1\/2:before{content:var(--tw-content);top:50%}.before\:bottom-0:before{content:var(--tw-content);bottom:calc(var(--spacing) * 0)}.before\:bottom-1\/2:before{content:var(--tw-content);bottom:50%}.before\:left-\[0\.4rem\]:before{content:var(--tw-content);left:.4rem}.before\:border-l:before{content:var(--tw-content);border-left-style:var(--tw-border-style);border-left-width:1px}.before\:border-\[\#e3e3e0\]:before{content:var(--tw-content);border-color:#e3e3e0}@media(hover:hover){.hover\:border-\[\#1915014a\]:hover{border-color:#1915014a}.hover\:border-\[\#19140035\]:hover{border-color:#19140035}.hover\:border-black:hover{border-color:var(--color-black)}.hover\:bg-black:hover{background-color:var(--color-black)}.hover\:bg-gray-100:hover{background-color:var(--color-gray-100)}.hover\:text-gray-400:hover{color:var(--color-gray-400)}.hover\:text-gray-700:hover{color:var(--color-gray-700)}}.focus\:border-blue-300:focus{border-color:var(--color-blue-300)}.focus\:ring:focus{--tw-ring-shadow:var(--tw-ring-inset,) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color,currentcolor);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.focus\:outline-none:focus{--tw-outline-style:none;outline-style:none}.active\:bg-gray-100:active{background-color:var(--color-gray-100)}.active\:text-gray-500:active{color:var(--color-gray-500)}.active\:text-gray-700:active{color:var(--color-gray-700)}.active\:text-gray-800:active{color:var(--color-gray-800)}@media(min-width:40rem){.sm\:flex{display:flex}.sm\:hidden{display:none}.sm\:flex-1{flex:1}.sm\:items-center{align-items:center}.sm\:justify-between{justify-content:space-between}.sm\:justify-start{justify-content:flex-start}.sm\:gap-2{gap:calc(var(--spacing) * 2)}.sm\:px-6{padding-inline:calc(var(--spacing) * 6)}.sm\:pt-0{padding-top:calc(var(--spacing) * 0)}}@media(min-width:64rem){.lg\:mt-10{margin-top:calc(var(--spacing) * 10)}.lg\:mb-0{margin-bottom:calc(var(--spacing) * 0)}.lg\:mb-6{margin-bottom:calc(var(--spacing) * 6)}.lg\:-ml-px{margin-left:-1px}.lg\:ml-0{margin-left:calc(var(--spacing) * 0)}.lg\:block{display:block}.lg\:aspect-auto{aspect-ratio:auto}.lg\:w-\[438px\]{width:438px}.lg\:max-w-4xl{max-width:var(--container-4xl)}.lg\:grow{flex-grow:1}.lg\:flex-row{flex-direction:row}.lg\:justify-center{justify-content:center}.lg\:rounded-t-none{border-top-left-radius:0;border-top-right-radius:0}.lg\:rounded-tl-lg{border-top-left-radius:var(--radius-lg)}.lg\:rounded-r-lg{border-top-right-radius:var(--radius-lg);border-bottom-right-radius:var(--radius-lg)}.lg\:rounded-br-none{border-bottom-right-radius:0}.lg\:p-8{padding:calc(var(--spacing) * 8)}.lg\:p-20{padding:calc(var(--spacing) * 20)}.lg\:px-8{padding-inline:calc(var(--spacing) * 8)}.lg\:pb-10{padding-bottom:calc(var(--spacing) * 10)}}.rtl\:flex-row-reverse:where(:dir(rtl),[dir=rtl],[dir=rtl] *){flex-direction:row-reverse}@media(prefers-color-scheme:dark){.dark\:border-\[\#3E3E3A\]{border-color:#3e3e3a}.dark\:border-\[\#eeeeec\]{border-color:#eeeeec}.dark\:border-gray-600{border-color:var(--color-gray-600)}.dark\:bg-\[\#0a0a0a\]{background-color:#0a0a0a}.dark\:bg-\[\#1D0002\]{background-color:#1d0002}.dark\:bg-\[\#3E3E3A\]{background-color:#3e3e3a}.dark\:bg-\[\#161615\]{background-color:#161615}.dark\:bg-\[\#eeeeec\]{background-color:#eeeeec}.dark\:bg-gray-700{background-color:var(--color-gray-700)}.dark\:bg-gray-800{background-color:var(--color-gray-800)}.dark\:bg-gray-900{background-color:var(--color-gray-900)}.dark\:text-\[\#1C1C1A\]{color:#1c1c1a}.dark\:text-\[\#4B0600\]{color:#4b0600}.dark\:text-\[\#391800\]{color:#391800}.dark\:text-\[\#733000\]{color:#733000}.dark\:text-\[\#A1A09A\]{color:#a1a09a}.dark\:text-\[\#EDEDEC\]{color:#ededec}.dark\:text-\[\#F61500\]{color:#f61500}.dark\:text-\[\#FF4433\]{color:#f43}.dark\:text-black{color:var(--color-black)}.dark\:text-gray-200{color:var(--color-gray-200)}.dark\:text-gray-300{color:var(--color-gray-300)}.dark\:text-gray-400{color:var(--color-gray-400)}.dark\:text-gray-600{color:var(--color-gray-600)}.dark\:mix-blend-hard-light{mix-blend-mode:hard-light}.dark\:mix-blend-normal{mix-blend-mode:normal}.dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#fffaed2d);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.dark\:\[--stroke-color\:\#FF750F\]{--stroke-color:#ff750f}.dark\:before\:border-\[\#3E3E3A\]:before{content:var(--tw-content);border-color:#3e3e3a}@media(hover:hover){.dark\:hover\:border-\[\#3E3E3A\]:hover{border-color:#3e3e3a}.dark\:hover\:border-\[\#62605b\]:hover{border-color:#62605b}.dark\:hover\:border-white:hover{border-color:var(--color-white)}.dark\:hover\:bg-gray-900:hover{background-color:var(--color-gray-900)}.dark\:hover\:bg-white:hover{background-color:var(--color-white)}.dark\:hover\:text-gray-200:hover{color:var(--color-gray-200)}.dark\:hover\:text-gray-300:hover{color:var(--color-gray-300)}}.dark\:focus\:border-blue-700:focus{border-color:var(--color-blue-700)}.dark\:focus\:border-blue-800:focus{border-color:var(--color-blue-800)}.dark\:active\:bg-gray-700:active{background-color:var(--color-gray-700)}.dark\:active\:text-gray-300:active{color:var(--color-gray-300)}}@starting-style{.starting\:opacity-0{opacity:0}}@media(prefers-reduced-motion:no-preference){@starting-style{.motion-safe\:starting\:-translate-x-\[26px\]{--tw-translate-x: -26px ;translate:var(--tw-translate-x) var(--tw-translate-y)}}@starting-style{.motion-safe\:starting\:-translate-x-\[51px\]{--tw-translate-x: -51px ;translate:var(--tw-translate-x) var(--tw-translate-y)}}@starting-style{.motion-safe\:starting\:-translate-x-\[78px\]{--tw-translate-x: -78px ;translate:var(--tw-translate-x) var(--tw-translate-y)}}@starting-style{.motion-safe\:starting\:-translate-x-\[102px\]{--tw-translate-x: -102px ;translate:var(--tw-translate-x) var(--tw-translate-y)}}@starting-style{.motion-safe\:starting\:translate-y-6{--tw-translate-y:calc(var(--spacing) * 6);translate:var(--tw-translate-x) var(--tw-translate-y)}}}}@property --tw-translate-x{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-y{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-z{syntax:"*";inherits:false;initial-value:0}@property --tw-rotate-x{syntax:"*";inherits:false}@property --tw-rotate-y{syntax:"*";inherits:false}@property --tw-rotate-z{syntax:"*";inherits:false}@property --tw-skew-x{syntax:"*";inherits:false}@property --tw-skew-y{syntax:"*";inherits:false}@property --tw-space-x-reverse{syntax:"*";inherits:false;initial-value:0}@property --tw-border-style{syntax:"*";inherits:false;initial-value:solid}@property --tw-leading{syntax:"*";inherits:false}@property --tw-font-weight{syntax:"*";inherits:false}@property --tw-tracking{syntax:"*";inherits:false}@property --tw-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-shadow-color{syntax:"*";inherits:false}@property --tw-shadow-alpha{syntax:"<percentage>";inherits:false;initial-value:100%}@property --tw-inset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-shadow-color{syntax:"*";inherits:false}@property --tw-inset-shadow-alpha{syntax:"<percentage>";inherits:false;initial-value:100%}@property --tw-ring-color{syntax:"*";inherits:false}@property --tw-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-ring-color{syntax:"*";inherits:false}@property --tw-inset-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-ring-inset{syntax:"*";inherits:false}@property --tw-ring-offset-width{syntax:"<length>";inherits:false;initial-value:0}@property --tw-ring-offset-color{syntax:"*";inherits:false;initial-value:#fff}@property --tw-ring-offset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-blur{syntax:"*";inherits:false}@property --tw-brightness{syntax:"*";inherits:false}@property --tw-contrast{syntax:"*";inherits:false}@property --tw-grayscale{syntax:"*";inherits:false}@property --tw-hue-rotate{syntax:"*";inherits:false}@property --tw-invert{syntax:"*";inherits:false}@property --tw-opacity{syntax:"*";inherits:false}@property --tw-saturate{syntax:"*";inherits:false}@property --tw-sepia{syntax:"*";inherits:false}@property --tw-drop-shadow{syntax:"*";inherits:false}@property --tw-drop-shadow-color{syntax:"*";inherits:false}@property --tw-drop-shadow-alpha{syntax:"<percentage>";inherits:false;initial-value:100%}@property --tw-drop-shadow-size{syntax:"*";inherits:false}@property --tw-duration{syntax:"*";inherits:false}@property --tw-ease{syntax:"*";inherits:false}@property --tw-content{syntax:"*";inherits:false;initial-value:""}@keyframes spin{to{transform:rotate(360deg)}}@keyframes ping{75%,to{opacity:0;transform:scale(2)}}@keyframes pulse{50%{opacity:.5}}@keyframes bounce{0%,to{animation-timing-function:cubic-bezier(.8,0,1,1);transform:translateY(-25%)}50%{animation-timing-function:cubic-bezier(0,0,.2,1);transform:none}}
            </style>
        @endif
    </head>
    <body>
    <div
        class="flex flex-col items-start relative [background:linear-gradient(0deg,rgba(254,249,243,1)_0%,rgba(254,249,243,1)_100%),linear-gradient(0deg,rgba(255,255,255,1)_0%,rgba(255,255,255,1)_100%)] overflow-y-scroll">
        <header
            class="flex flex-col w-full items-start absolute top-0 left-0 bg-[#fef9f399] shadow-[0px_4px_30px_#00000008] backdrop-blur-md backdrop-brightness-[100%] [-webkit-backdrop-filter:blur(12px)_brightness(100%)] z-10">
            <div class="flex h-20 items-center justify-between px-16 py-0 relative self-stretch w-full">
                <a href="#" class="inline-flex items-center gap-4 relative flex-[0_0_auto]" aria-label="Lulopop home">
                    <span
                        class="relative w-10 h-10 rounded-full shadow-[0px_0px_15px_#614da533] bg-[url(legacy:image:md5:2:555-no-children)] bg-cover bg-[50%_50%]"
                        aria-hidden="true"></span>
                    <span class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                        <span
                            class="flex items-center [font-family:'Bricolage_Grotesque-SemiBold',Helvetica] font-semibold text-[#614da5] text-[32px] tracking-[-0.80px] leading-10 whitespace-nowrap relative w-fit mt-[-1.00px]">Lulopop</span>
                    </span>
                </a>
                <nav class="inline-flex items-center gap-10 relative flex-[0_0_auto]" aria-label="Primary navigation">
                    <a href="#shop" class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                        <span
                            class="flex items-center [font-family:'Plus_Jakarta_Sans-SemiBold',Helvetica] font-semibold text-[#484551] text-base tracking-[0] leading-6 whitespace-nowrap relative w-fit mt-[-1.00px]">Shop</span>
                    </a>
                    <a href="#flavors" class="inline-flex flex-col items-start relative flex-[0_0_auto]"
                        aria-current="page">
                        <span
                            class="flex items-center [font-family:'Plus_Jakarta_Sans-Bold',Helvetica] font-bold text-[#614da5] text-base tracking-[0] leading-6 whitespace-nowrap relative w-fit mt-[-1.00px]">Flavors</span>
                    </a>
                    <a href="#our-story" class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                        <span
                            class="flex items-center [font-family:'Plus_Jakarta_Sans-SemiBold',Helvetica] font-semibold text-[#484551] text-base tracking-[0] leading-6 whitespace-nowrap relative w-fit mt-[-1.00px]">Our
                            Story</span>
                    </a>
                </nav>
                <div class="inline-flex items-center gap-6 relative flex-[0_0_auto]">
                    <button type="button"
                        class="all-unset box-border inline-flex flex-col items-center justify-center p-2 relative flex-[0_0_auto]"
                        aria-label="Shopping bag, 0 items">
                        <span class="inline-flex items-start justify-center relative flex-[0_0_auto]">
                            <img class="relative w-[18.67px] h-[23.33px]" src="img/icon-3.svg" alt="">
                        </span>
                        <span
                            class="w-5 h-5 justify-center pt-0.5 pb-[3px] px-0 absolute top-0 right-0 bg-[#4d6700] rounded-full flex items-center"
                            aria-hidden="true">
                            <span
                                class="flex items-center justify-center [font-family:'Plus_Jakarta_Sans-Bold',Helvetica] font-bold text-white text-[10px] text-center tracking-[0] leading-[15px] whitespace-nowrap relative w-fit mt-[-1.00px]">0</span>
                        </span>
                    </button>
                    <a href="#account"
                        class="relative w-9 h-9 rounded-full border-2 border-solid border-[#ece7e2] bg-[url(legacy:image:md5:2:571-no-children)] bg-cover bg-[50%_50%]"
                        aria-label="Account"></a>
                </div>
            </div>
        </header>
        <main>
            <section
                class="flex flex-col items-start pt-20 pb-0 px-0 relative self-stretch w-full flex-[0_0_auto] bg-[#fef9f3]"
                aria-labelledby="hero-heading">
                <div class="flex flex-col items-start relative self-stretch w-full flex-[0_0_auto]">
                    <div
                        class="flex flex-col items-center justify-center pt-16 pb-[120px] px-16 relative self-stretch w-full flex-[0_0_auto]">
                        <div class="absolute w-full h-full top-0 left-0" aria-hidden="true">
                            <div
                                class="absolute top-10 left-10 w-[512px] h-[512px] bg-[#ffdad64c] rounded-full blur-2xl mix-blend-multiply">
                            </div>
                            <div
                                class="right-10 bottom-10 w-[640px] h-[640px] bg-[#e7deff4c] blur-[50px] mix-blend-multiply absolute rounded-full">
                            </div>
                        </div>
                        <div class="inline-flex flex-col max-w-4xl items-center gap-8 relative flex-[0_0_auto]">
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 relative flex-[0_0_auto] bg-[#ece7e2] rounded-full shadow-[0px_1px_2px_#0000000d]">
                                <span class="inline-flex flex-col items-center relative flex-[0_0_auto]">
                                    <img class="relative w-[18.33px] h-[18.33px]" src="img/icon-4.svg" alt="">
                                </span>
                                <span
                                    class="flex items-center justify-center [font-family:'Plus_Jakarta_Sans-Bold',Helvetica] font-bold text-[#484551] text-sm text-center tracking-[1.40px] leading-5 whitespace-nowrap relative w-fit mt-[-1.00px]">SINCE
                                    2024</span>
                            </div>
                            <h1 id="hero-heading"
                                class="relative w-fit [font-family:'Bricolage_Grotesque-ExtraBold',Helvetica] font-normal text-transparent text-7xl text-center tracking-[-1.44px] leading-[80px] whitespace-nowrap">
                                <span class="font-extrabold text-[#1d1b18] tracking-[-1.04px]">Sip some </span><span
                                    class="font-extrabold text-[#614da5] tracking-[-1.04px]">sunshine</span><span
                                    class="font-extrabold text-[#1d1b18] tracking-[-1.04px]">.</span>
                            </h1>
                            <div
                                class="inline-flex flex-col max-w-2xl items-center px-[0.27px] py-0 relative flex-[0_0_auto]">
                                <p
                                    class="relative w-fit mt-[-1.00px] [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-lg text-center tracking-[0] leading-7">
                                    We started Lulopop with a simple idea: boba tea shouldn&#39;t just taste good,
                                    it<br>should make you smile. Every cup is crafted with real ingredients, vibrant
                                    flavors,<br>and a little bit of magic.
                                </p>
                            </div>
                            <figure
                                class="flex flex-col max-w-lg w-[512px] items-start pt-8 pb-0 px-0 relative flex-[0_0_auto]">
                                <div
                                    class="flex flex-col max-w-lg items-start justify-center relative w-full flex-[0_0_auto] bg-[#ffffff01] rounded-[48px] overflow-hidden shadow-[0px_25px_50px_-12px_#00000040] aspect-[1]">
                                    <div class="relative self-stretch w-full h-[512px] bg-[url(legacy:image:md5:2:426-no-children)] bg-cover bg-[50%_50%]"
                                        role="img" aria-label="Strawberry Pop boba tea character"></div>
                                    <div class="absolute w-full h-full top-0 left-0 [background:linear-gradient(0deg,rgba(0,0,0,0.2)_0%,rgba(0,0,0,0)_100%)]"
                                        aria-hidden="true"></div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </section>
            <section id="our-story"
                class="flex flex-col items-start px-0 py-[120px] relative self-stretch w-full flex-[0_0_auto] bg-[#f8f3ed]"
                aria-labelledby="companion-heading">
                <div
                    class="flex max-w-screen-xl items-center justify-center gap-6 px-16 py-0 relative w-full flex-[0_0_auto]">
                    <div class="flex flex-col items-start gap-8 pl-0 pr-12 py-0 relative flex-1 grow">
                        <div class="flex-col items-start self-stretch w-full flex-[0_0_auto] flex relative">
                            <h2 id="companion-heading"
                                class="relative self-stretch mt-[-1.00px] [font-family:'Bricolage_Grotesque-Bold',Helvetica] font-bold text-[#1d1b18] text-5xl tracking-[0] leading-[56px]">
                                More than just a<br>drink. A daily<br>companion.</h2>
                        </div>
                        <div class="flex flex-col items-start gap-6 relative self-stretch w-full flex-[0_0_auto]">
                            <article class="flex items-start gap-4 relative self-stretch w-full flex-[0_0_auto]">
                                <div
                                    class="flex w-12 h-12 items-center justify-center relative bg-[#ccf078] rounded-full shadow-[0px_1px_2px_#0000000d]">
                                    <span class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                                        <img class="relative w-[17px] h-[16.99px]" src="img/image.svg" alt="">
                                    </span>
                                </div>
                                <div class="inline-flex flex-col items-start gap-2 relative flex-[0_0_auto]">
                                    <h3
                                        class="flex items-center [font-family:'Plus_Jakarta_Sans-SemiBold',Helvetica] font-semibold text-[#1d1b18] text-base tracking-[0] leading-6 whitespace-nowrap relative w-fit mt-[-1.00px]">
                                        Real Ingredients</h3>
                                    <p
                                        class="[font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base tracking-[0] leading-6 relative w-fit mt-[-1.00px]">
                                        We source premium tea leaves and fresh fruit. No artificial<br>syrups, just
                                        pure, vibrant flavors.</p>
                                </div>
                            </article>
                            <article class="flex items-start gap-4 relative self-stretch w-full flex-[0_0_auto]">
                                <div
                                    class="flex w-12 h-12 items-center justify-center relative bg-[#c7a938] rounded-full shadow-[0px_1px_2px_#0000000d]">
                                    <span class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                                        <img class="relative w-5 h-5" src="img/icon-2.svg" alt="">
                                    </span>
                                </div>
                                <div class="inline-flex flex-col items-start gap-2 relative flex-[0_0_auto]">
                                    <h3
                                        class="flex items-center [font-family:'Plus_Jakarta_Sans-SemiBold',Helvetica] font-semibold text-[#1d1b18] text-base tracking-[0] leading-6 whitespace-nowrap relative w-fit mt-[-1.00px]">
                                        Joy in Every Drop</h3>
                                    <p
                                        class="[font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base tracking-[0] leading-6 relative w-fit mt-[-1.00px]">
                                        Our signature boba characters are designed to bring a pop<br>of joy and
                                        playfulness to your routine.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                    <figure
                        class="rounded-[48px] shadow-[0px_8px_10px_-6px_#0000001a,0px_20px_25px_-5px_#0000001a] aspect-[0.8] flex flex-col items-start justify-center relative flex-1 grow bg-[#ffffff01] overflow-hidden">
                        <div class="relative self-stretch w-full h-[705px] bg-[url(legacy:image:md5:2:453-no-children)] bg-cover bg-[50%_50%]"
                            role="img" aria-label="Matcha Breeze boba tea character"></div>
                        <figcaption
                            class="flex flex-col w-full items-start p-8 absolute left-0 bottom-0 backdrop-blur-[2px] backdrop-brightness-[100%] [-webkit-backdrop-filter:blur(2px)_brightness(100%)] [background:linear-gradient(0deg,rgba(50,48,44,0.8)_0%,rgba(50,48,44,0)_100%)]">
                            <span class="flex flex-col items-start relative self-stretch w-full flex-[0_0_auto]">
                                <span
                                    class="relative flex items-center self-stretch mt-[-1.00px] [font-family:'Bricolage_Grotesque-SemiBold',Helvetica] font-semibold text-[#f5f0ea] text-[32px] tracking-[0] leading-10">Matcha
                                    Breeze</span>
                            </span>
                        </figcaption>
                    </figure>
                </div>
            </section>
            <section id="flavors"
                class="flex flex-col items-start px-16 py-[120px] relative self-stretch w-full flex-[0_0_auto]"
                aria-labelledby="design-heading">
                <div
                    class="flex flex-col max-w-screen-xl items-start relative w-full flex-[0_0_auto] bg-[#7a67c0] rounded-[64px] overflow-hidden shadow-[0px_8px_10px_-6px_#0000001a,0px_20px_25px_-5px_#0000001a]">
                    <img class="absolute w-full h-full top-0 left-0 mix-blend-overlay" src="img/image.png" alt=""
                        aria-hidden="true">
                    <div
                        class="flex items-center justify-center gap-12 p-16 relative self-stretch w-full flex-[0_0_auto]">
                        <div class="flex flex-col items-start gap-6 relative flex-1 grow">
                            <div
                                class="inline-flex items-center px-4 py-2 relative flex-[0_0_auto] bg-[#fffbff1a] rounded-full border border-solid border-[#fffbff33] backdrop-blur-[6px] backdrop-brightness-[100%] [-webkit-backdrop-filter:blur(6px)_brightness(100%)]">
                                <span class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                                    <span
                                        class="flex items-center [font-family:'Plus_Jakarta_Sans-Bold',Helvetica] font-bold text-[#fffbff] text-sm tracking-[1.40px] leading-5 whitespace-nowrap relative w-fit mt-[-1.00px]">THE
                                        DESIGN PROCESS</span>
                                </span>
                            </div>
                            <div class="items-start flex flex-col relative self-stretch w-full flex-[0_0_auto]">
                                <h2 id="design-heading"
                                    class="relative self-stretch mt-[-1.00px] [font-family:'Bricolage_Grotesque-Bold',Helvetica] font-bold text-[#fffbff] text-5xl tracking-[0] leading-[56px]">
                                    Crafted with<br>Character</h2>
                            </div>
                            <div
                                class="flex flex-col max-w-md w-[448px] items-start relative flex-[0_0_auto] opacity-90">
                                <p
                                    class="[font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#fffbff] text-lg tracking-[0] leading-7 relative w-fit mt-[-1.00px]">
                                    Each flavor profile is paired with a bespoke<br>character. From the energetic
                                    Strawberry Pop to the<br>serene Taro Dream, we craft personalities that match<br>the
                                    tasting notes of our premium blends.</p>
                            </div>
                            <div class="inline-flex flex-col items-start pt-4 pb-0 px-0 relative flex-[0_0_auto]">
                                <a href="#characters"
                                    class="inline-flex items-center justify-center gap-2 px-8 py-4 relative flex-[0_0_auto] bg-[#fffbff] rounded-full">
                                    <span
                                        class="absolute w-full h-full top-0 left-0 bg-[#ffffff01] rounded-full shadow-[0px_2px_4px_-2px_#0000001a,0px_4px_6px_-1px_#0000001a]"
                                        aria-hidden="true"></span>
                                    <span
                                        class="flex items-center justify-center [font-family:'Plus_Jakarta_Sans-SemiBold',Helvetica] font-semibold text-[#7a67c0] text-base text-center tracking-[0] leading-6 whitespace-nowrap relative w-fit mt-[-1.00px]">Meet
                                        the Characters</span>
                                    <span class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                                        <img class="relative w-4 h-4" src="img/icon-5.svg" alt="">
                                    </span>
                                </a>
                            </div>
                        </div>
                        <figure
                            class="rounded-[32px] shadow-[0px_25px_50px_-12px_#00000040] aspect-[1.33] flex flex-col items-start justify-center relative flex-1 grow bg-[#ffffff01] overflow-hidden">
                            <div class="relative self-stretch w-full h-[366px] bg-[url(legacy:image:md5:2:476-no-children)] bg-cover bg-[50%_50%]"
                                role="img" aria-label="Lulopop character illustration"></div>
                        </figure>
                    </div>
                </div>
            </section>
            <section id="shop"
                class="flex flex-col items-start px-0 py-[120px] relative self-stretch w-full flex-[0_0_auto] bg-[#fef9f3]"
                aria-labelledby="promise-heading">
                <div
                    class="flex flex-col max-w-screen-xl items-start gap-16 px-16 py-0 relative w-full flex-[0_0_auto]">
                    <div class="items-center flex flex-col relative self-stretch w-full flex-[0_0_auto]">
                        <h2 id="promise-heading"
                            class="flex items-center justify-center [font-family:'Bricolage_Grotesque-Bold',Helvetica] font-bold text-[#1d1b18] text-5xl text-center tracking-[0] leading-[56px] whitespace-nowrap relative w-fit mt-[-1.00px]">
                            The Lulopop Promise</h2>
                    </div>
                    <div class="flex items-start justify-center gap-8 relative self-stretch w-full flex-[0_0_auto]">
                        <article
                            class="flex-col w-[362.66px] gap-6 p-8 relative bg-[#f2ede7] rounded-3xl shadow-[0px_1px_2px_#0000000d] flex items-center">
                            <div class="flex w-24 h-24 items-center justify-center relative bg-[#ffdad6] rounded-full">
                                <span class="inline-flex flex-col items-center relative flex-[0_0_auto]">
                                    <img class="relative w-9 h-9" src="img/icon-8.svg" alt="">
                                </span>
                            </div>
                            <h3
                                class="items-center justify-center w-fit [font-family:'Bricolage_Grotesque-SemiBold',Helvetica] font-semibold text-[#1d1b18] text-[32px] text-center tracking-[0] leading-10 whitespace-nowrap flex relative">
                                Premium Tea</h3>
                            <div
                                class="inline-flex flex-col items-center pl-[19.17px] pr-[19.18px] py-0 relative flex-[0_0_auto]">
                                <p
                                    class="[font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base text-center tracking-[0] leading-6 relative w-fit mt-[-1.00px]">
                                    Sourced directly from sustainable<br>farms to ensure a robust, authentic<br>base for
                                    every drink.</p>
                            </div>
                        </article>
                        <article
                            class="flex flex-col w-[362.67px] items-center gap-6 p-8 relative bg-[#f2ede7] rounded-3xl shadow-[0px_1px_2px_#0000000d]">
                            <div class="w-24 h-24 justify-center relative bg-[#ccf078] rounded-full flex items-center">
                                <span class="inline-flex flex-col items-center relative flex-[0_0_auto]">
                                    <img class="relative w-7 h-10" src="img/icon-7.svg" alt="">
                                </span>
                            </div>
                            <h3
                                class="items-center justify-center w-fit [font-family:'Bricolage_Grotesque-SemiBold',Helvetica] font-semibold text-[#1d1b18] text-[32px] text-center tracking-[0] leading-10 whitespace-nowrap flex relative">
                                Real Fruit</h3>
                            <div
                                class="inline-flex flex-col items-center pl-[17.07px] pr-[17.08px] py-0 relative flex-[0_0_auto]">
                                <p
                                    class="[font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base text-center tracking-[0] leading-6 relative w-fit mt-[-1.00px]">
                                    We blend real fruit purees and fresh<br>chunks, never artificial powders or<br>heavy
                                    syrups.</p>
                            </div>
                        </article>
                        <article
                            class="flex-col w-[362.66px] gap-6 p-8 relative bg-[#f2ede7] rounded-3xl shadow-[0px_1px_2px_#0000000d] flex items-center">
                            <div class="w-24 h-24 justify-center relative bg-[#c7a938] rounded-full flex items-center">
                                <span class="inline-flex flex-col items-center relative flex-[0_0_auto]">
                                    <img class="relative w-[43.1px] h-[41px]" src="img/icon.svg" alt="">
                                </span>
                            </div>
                            <h3
                                class="items-center justify-center w-fit [font-family:'Bricolage_Grotesque-SemiBold',Helvetica] font-semibold text-[#1d1b18] text-[32px] text-center tracking-[0] leading-10 whitespace-nowrap flex relative">
                                Playful Vibes</h3>
                            <div class="inline-flex flex-col items-center px-[1.61px] py-0 relative flex-[0_0_auto]">
                                <p
                                    class="[font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base text-center tracking-[0] leading-6 relative w-fit mt-[-1.00px]">
                                    Because life is too short for boring<br>beverages. We believe every sip should<br>be
                                    a celebration.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
            <section
                class="pt-[120px] pb-[200px] px-32 self-stretch flex flex-col items-start relative w-full flex-[0_0_auto]"
                aria-labelledby="location-heading">
                <div
                    class="max-w-screen-lg p-24 bg-[#e6e2dc] rounded-[64px] overflow-hidden border border-solid border-[#cac4d34c] shadow-[0px_4px_6px_-4px_#0000001a,0px_10px_15px_-3px_#0000001a] flex flex-col items-start relative w-full flex-[0_0_auto]">
                    <div class="top-[-95px] left-[-95px] w-64 h-64 bg-[#614da533] blur-[25px] absolute rounded-full"
                        aria-hidden="true"></div>
                    <div class="right-[-95px] bottom-[-95px] w-64 h-64 bg-[#4d670033] blur-[25px] absolute rounded-full"
                        aria-hidden="true"></div>
                    <div class="flex flex-col items-center gap-8 relative self-stretch w-full flex-[0_0_auto]">
                        <h2 id="location-heading"
                            class="relative w-fit mt-[-1.00px] [font-family:'Bricolage_Grotesque-ExtraBold',Helvetica] font-extrabold text-transparent text-7xl text-center tracking-[-1.44px] leading-[80px] whitespace-nowrap">
                            <span class="text-[#484551] tracking-[-1.04px]">Ready for a </span><span
                                class="text-[#614da5] tracking-[-1.04px]">pop</span><span
                                class="text-[#484551] tracking-[-1.04px]"> of joy?</span>
                        </h2>
                        <div
                            class="inline-flex flex-col max-w-xl items-center pl-[11.09px] pr-[11.11px] py-0 relative flex-[0_0_auto]">
                            <p
                                class="relative w-fit mt-[-1.00px] [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-lg text-center tracking-[0] leading-7">
                                Find your nearest Lulopop location and discover your new favorite<br>character companion
                                today.</p>
                        </div>
                        <a href="#locations"
                            class="all-unset box-border inline-flex items-center gap-[11.99px] px-10 py-5 relative flex-[0_0_auto] bg-[#614da5] rounded-full shadow-[0px_8px_30px_#614da54c]">
                            <span class="inline-flex flex-col items-center relative flex-[0_0_auto]">
                                <img class="relative w-4 h-5" src="img/icon-6.svg" alt="">
                            </span>
                            <span
                                class="flex items-center justify-center [font-family:'Plus_Jakarta_Sans-SemiBold',Helvetica] font-semibold text-white text-base text-center tracking-[0] leading-6 whitespace-nowrap relative w-fit mt-[-1.00px]">Find
                                a Location</span>
                        </a>
                    </div>
                </div>
            </section>
        </main>
        <footer
            class="flex flex-col items-start gap-16 px-0 py-[120px] relative self-stretch w-full flex-[0_0_auto] bg-white border-t [border-top-style:solid] [border-right-style:none] [border-bottom-style:none] [border-left-style:none] border-[#e6e2dc4c]">
            <div class="grid grid-cols-4 grid-rows-[136px] max-w-screen-xl h-fit gap-6 px-16 py-0">
                <div class="relative row-[1_/_2] col-[1_/_3] w-full h-fit flex flex-col items-start gap-6">
                    <a href="#" class="flex items-center gap-3 relative self-stretch w-full flex-[0_0_auto]"
                        aria-label="Lulopop home">
                        <span
                            class="relative max-w-[564px] w-8 h-8 rounded-full bg-[url(legacy:image:md5:2:519-no-children)] bg-cover bg-[50%_50%]"
                            aria-hidden="true"></span>
                        <span class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                            <span
                                class="flex items-center [font-family:'Bricolage_Grotesque-SemiBold',Helvetica] font-semibold text-[#614da5] text-[32px] tracking-[0] leading-10 whitespace-nowrap relative w-fit mt-[-1.00px]">Lulopop</span>
                        </span>
                    </a>
                    <div class="flex flex-col max-w-sm w-96 items-start relative flex-[0_0_auto]">
                        <p
                            class="[font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base tracking-[0] leading-6 relative w-fit mt-[-1.00px]">
                            Sip some sunshine. Our handcrafted boba brings a<br>pop of joy to your daily routine with
                            fresh<br>ingredients and vibrant flavors.</p>
                    </div>
                </div>
                <nav class="relative row-[1_/_2] col-[3_/_4] w-full h-fit flex flex-col items-start gap-4 pt-0 pb-3 px-0"
                    aria-label="Footer navigation">
                    <div class="flex-col items-start self-stretch w-full flex-[0_0_auto] flex relative">
                        <h2
                            class="relative flex items-center self-stretch mt-[-1.00px] [font-family:'Plus_Jakarta_Sans-Bold',Helvetica] font-bold text-[#1d1b18] text-sm tracking-[1.40px] leading-5">
                            QUICK LINKS</h2>
                    </div>
                    <div class="flex flex-col items-start gap-2 relative self-stretch w-full flex-[0_0_auto]">
                        <a href="#shop" class="flex self-stretch w-full flex-col items-start relative flex-[0_0_auto]">
                            <span
                                class="relative flex items-center self-stretch mt-[-1.00px] [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base tracking-[0] leading-6">Shop
                                All</span>
                        </a>
                        <a href="#gifts" class="flex self-stretch w-full flex-col items-start relative flex-[0_0_auto]">
                            <span
                                class="relative flex items-center self-stretch mt-[-1.00px] [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base tracking-[0] leading-6">Gifts</span>
                        </a>
                        <a href="#locations"
                            class="flex self-stretch w-full flex-col items-start relative flex-[0_0_auto]">
                            <span
                                class="relative flex items-center self-stretch mt-[-1.00px] [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-base tracking-[0] leading-6">Locations</span>
                        </a>
                    </div>
                </nav>
                <section
                    class="relative row-[1_/_2] col-[4_/_5] w-full h-fit flex flex-col items-start gap-4 pt-0 pb-[76px] px-0"
                    aria-labelledby="connect-heading">
                    <div class="flex flex-col items-start relative self-stretch w-full flex-[0_0_auto]">
                        <h2 id="connect-heading"
                            class="relative flex items-center self-stretch mt-[-1.00px] [font-family:'Plus_Jakarta_Sans-Bold',Helvetica] font-bold text-[#1d1b18] text-sm tracking-[1.40px] leading-5">
                            CONNECT</h2>
                    </div>
                    <img class="relative self-stretch w-full flex-[0_0_auto] object-cover" src="img/container.svg"
                        alt="Lulopop social media links">
                </section>
            </div>
            <div
                class="flex max-w-screen-xl items-center justify-between pt-8 pb-0 px-16 relative w-full flex-[0_0_auto] border-t [border-top-style:solid] border-[#e6e2dc33]">
                <div class="inline-flex flex-col items-start relative flex-[0_0_auto]">
                    <p
                        class="flex items-center [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-sm tracking-[0] leading-5 whitespace-nowrap relative w-fit mt-[-1.00px]">
                        © 2024 Lulopop Tea Co. All rights reserved.</p>
                </div>
                <nav class="inline-flex items-start gap-8 relative flex-[0_0_auto]" aria-label="Legal navigation">
                    <a href="#privacy" class="inline-flex flex-col items-start relative self-stretch flex-[0_0_auto]">
                        <span
                            class="flex items-center [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-sm tracking-[0] leading-5 whitespace-nowrap relative w-fit mt-[-1.00px]">Privacy
                            Policy</span>
                    </a>
                    <a href="#terms" class="inline-flex flex-col items-start relative self-stretch flex-[0_0_auto]">
                        <span
                            class="flex items-center [font-family:'Plus_Jakarta_Sans-Regular',Helvetica] font-normal text-[#484551] text-sm tracking-[0] leading-5 whitespace-nowrap relative w-fit mt-[-1.00px]">Terms
                            of Service</span>
                    </a>
                </nav>
            </div>
        </footer>
    </div>
    </body>
    s
</html>
