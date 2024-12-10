@extends('layouts.admin.app')
@section('style')
    <style>
        :root {
            --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --msger-bg: #fff;
            --border: 2px solid #ddd;
            --left-msg-bg: #ececec;
            --right-msg-bg: #579ffb;
        }

        .msger {
            display: flex;
            flex-flow: column wrap;
            justify-content: space-between;
            width: 100%;
            max-width: 867px;
            margin: 25px 10px;
            height: calc(100% - 50px);
            border: var(--border);
            border-radius: 5px;
            background: var(--msger-bg);
            box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
        }

        .msger-header {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: var(--border);
            background: #eee;
            color: #666;
        }

        .msger-chat {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .msger-chat::-webkit-scrollbar {
            width: 6px;
        }

        .msger-chat::-webkit-scrollbar-track {
            background: #ddd;
        }

        .msger-chat::-webkit-scrollbar-thumb {
            background: #bdbdbd;
        }

        .msg {
            display: flex;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .msg:last-of-type {
            margin: 0;
        }

        .msg-img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            background: #ddd;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border-radius: 50%;
        }

        .msg-bubble {
            max-width: 450px;
            padding: 15px;
            border-radius: 15px;
            background: var(--left-msg-bg);
        }

        .msg-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .msg-info-name {
            margin-right: 10px;
            font-weight: bold;
        }

        .msg-info-time {
            font-size: 0.85em;
        }

        .left-msg .msg-bubble {
            border-bottom-left-radius: 0;
        }

        .right-msg {
            flex-direction: row-reverse;
        }

        .right-msg .msg-bubble {
            background: var(--right-msg-bg);
            color: #fff;
            border-bottom-right-radius: 0;
        }

        .right-msg .msg-img {
            margin: 0 0 0 10px;
        }

        .msger-inputarea {
            display: flex;
            padding: 10px;
            border-top: var(--border);
            background: #eee;
        }

        .msger-inputarea * {
            padding: 10px;
            border: none;
            border-radius: 3px;
            font-size: 1em;
        }

        .msger-input {
            flex: 1;
            background: #ddd;
        }

        .msger-send-btn {
            margin-left: 10px;
            background: rgb(0, 196, 65);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.23s;
        }

        .msger-send-btn:hover {
            background: rgb(0, 180, 50);
        }

        .msger-chat {
            background-color: #fcfcfe;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='260' height='260' viewBox='0 0 260 260'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23dddddd' fill-opacity='0.4'%3E%3Cpath d='M24.37 16c.2.65.39 1.32.54 2H21.17l1.17 2.34.45.9-.24.11V28a5 5 0 0 1-2.23 8.94l-.02.06a8 8 0 0 1-7.75 6h-20a8 8 0 0 1-7.74-6l-.02-.06A5 5 0 0 1-17.45 28v-6.76l-.79-1.58-.44-.9.9-.44.63-.32H-20a23.01 23.01 0 0 1 44.37-2zm-36.82 2a1 1 0 0 0-.44.1l-3.1 1.56.89 1.79 1.31-.66a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .86.02l2.88-1.27a3 3 0 0 1 2.43 0l2.88 1.27a1 1 0 0 0 .85-.02l3.1-1.55-.89-1.79-1.42.71a3 3 0 0 1-2.56.06l-2.77-1.23a1 1 0 0 0-.4-.09h-.01a1 1 0 0 0-.4.09l-2.78 1.23a3 3 0 0 1-2.56-.06l-2.3-1.15a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1L.9 19.22a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01zm0-2h-4.9a21.01 21.01 0 0 1 39.61 0h-2.09l-.06-.13-.26.13h-32.31zm30.35 7.68l1.36-.68h1.3v2h-36v-1.15l.34-.17 1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0L2.26 23h2.59l1.36.68a3 3 0 0 0 2.56.06l1.67-.74h3.23l1.67.74a3 3 0 0 0 2.56-.06zM-13.82 27l16.37 4.91L18.93 27h-32.75zm-.63 2h.34l16.66 5 16.67-5h.33a3 3 0 1 1 0 6h-34a3 3 0 1 1 0-6zm1.35 8a6 6 0 0 0 5.65 4h20a6 6 0 0 0 5.66-4H-13.1z'/%3E%3Cpath id='path6_fill-copy' d='M284.37 16c.2.65.39 1.32.54 2H281.17l1.17 2.34.45.9-.24.11V28a5 5 0 0 1-2.23 8.94l-.02.06a8 8 0 0 1-7.75 6h-20a8 8 0 0 1-7.74-6l-.02-.06a5 5 0 0 1-2.24-8.94v-6.76l-.79-1.58-.44-.9.9-.44.63-.32H240a23.01 23.01 0 0 1 44.37-2zm-36.82 2a1 1 0 0 0-.44.1l-3.1 1.56.89 1.79 1.31-.66a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .86.02l2.88-1.27a3 3 0 0 1 2.43 0l2.88 1.27a1 1 0 0 0 .85-.02l3.1-1.55-.89-1.79-1.42.71a3 3 0 0 1-2.56.06l-2.77-1.23a1 1 0 0 0-.4-.09h-.01a1 1 0 0 0-.4.09l-2.78 1.23a3 3 0 0 1-2.56-.06l-2.3-1.15a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01zm0-2h-4.9a21.01 21.01 0 0 1 39.61 0h-2.09l-.06-.13-.26.13h-32.31zm30.35 7.68l1.36-.68h1.3v2h-36v-1.15l.34-.17 1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.56.06l1.67-.74h3.23l1.67.74a3 3 0 0 0 2.56-.06zM246.18 27l16.37 4.91L278.93 27h-32.75zm-.63 2h.34l16.66 5 16.67-5h.33a3 3 0 1 1 0 6h-34a3 3 0 1 1 0-6zm1.35 8a6 6 0 0 0 5.65 4h20a6 6 0 0 0 5.66-4H246.9z'/%3E%3Cpath d='M159.5 21.02A9 9 0 0 0 151 15h-42a9 9 0 0 0-8.5 6.02 6 6 0 0 0 .02 11.96A8.99 8.99 0 0 0 109 45h42a9 9 0 0 0 8.48-12.02 6 6 0 0 0 .02-11.96zM151 17h-42a7 7 0 0 0-6.33 4h54.66a7 7 0 0 0-6.33-4zm-9.34 26a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-4.34a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-4.34a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-7a7 7 0 1 1 0-14h42a7 7 0 1 1 0 14h-9.34zM109 27a9 9 0 0 0-7.48 4H101a4 4 0 1 1 0-8h58a4 4 0 0 1 0 8h-.52a9 9 0 0 0-7.48-4h-42z'/%3E%3Cpath d='M39 115a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm6-8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-3-29v-2h8v-6H40a4 4 0 0 0-4 4v10H22l-1.33 4-.67 2h2.19L26 130h26l3.81-40H58l-.67-2L56 84H42v-6zm-4-4v10h2V74h8v-2h-8a2 2 0 0 0-2 2zm2 12h14.56l.67 2H22.77l.67-2H40zm13.8 4H24.2l3.62 38h22.36l3.62-38z'/%3E%3Cpath d='M129 92h-6v4h-6v4h-6v14h-3l.24 2 3.76 32h36l3.76-32 .24-2h-3v-14h-6v-4h-6v-4h-8zm18 22v-12h-4v4h3v8h1zm-3 0v-6h-4v6h4zm-6 6v-16h-4v19.17c1.6-.7 2.97-1.8 4-3.17zm-6 3.8V100h-4v23.8a10.04 10.04 0 0 0 4 0zm-6-.63V104h-4v16a10.04 10.04 0 0 0 4 3.17zm-6-9.17v-6h-4v6h4zm-6 0v-8h3v-4h-4v12h1zm27-12v-4h-4v4h3v4h1v-4zm-6 0v-8h-4v4h3v4h1zm-6-4v-4h-4v8h1v-4h3zm-6 4v-4h-4v8h1v-4h3zm7 24a12 12 0 0 0 11.83-10h7.92l-3.53 30h-32.44l-3.53-30h7.92A12 12 0 0 0 130 126z'/%3E%3Cpath d='M212 86v2h-4v-2h4zm4 0h-2v2h2v-2zm-20 0v.1a5 5 0 0 0-.56 9.65l.06.25 1.12 4.48a2 2 0 0 0 1.94 1.52h.01l7.02 24.55a2 2 0 0 0 1.92 1.45h4.98a2 2 0 0 0 1.92-1.45l7.02-24.55a2 2 0 0 0 1.95-1.52L224.5 96l.06-.25a5 5 0 0 0-.56-9.65V86a14 14 0 0 0-28 0zm4 0h6v2h-9a3 3 0 1 0 0 6H223a3 3 0 1 0 0-6H220v-2h2a12 12 0 1 0-24 0h2zm-1.44 14l-1-4h24.88l-1 4h-22.88zm8.95 26l-6.86-24h18.7l-6.86 24h-4.98zM150 242a22 22 0 1 0 0-44 22 22 0 0 0 0 44zm24-22a24 24 0 1 1-48 0 24 24 0 0 1 48 0zm-28.38 17.73l2.04-.87a6 6 0 0 1 4.68 0l2.04.87a2 2 0 0 0 2.5-.82l1.14-1.9a6 6 0 0 1 3.79-2.75l2.15-.5a2 2 0 0 0 1.54-2.12l-.19-2.2a6 6 0 0 1 1.45-4.46l1.45-1.67a2 2 0 0 0 0-2.62l-1.45-1.67a6 6 0 0 1-1.45-4.46l.2-2.2a2 2 0 0 0-1.55-2.13l-2.15-.5a6 6 0 0 1-3.8-2.75l-1.13-1.9a2 2 0 0 0-2.5-.8l-2.04.86a6 6 0 0 1-4.68 0l-2.04-.87a2 2 0 0 0-2.5.82l-1.14 1.9a6 6 0 0 1-3.79 2.75l-2.15.5a2 2 0 0 0-1.54 2.12l.19 2.2a6 6 0 0 1-1.45 4.46l-1.45 1.67a2 2 0 0 0 0 2.62l1.45 1.67a6 6 0 0 1 1.45 4.46l-.2 2.2a2 2 0 0 0 1.55 2.13l2.15.5a6 6 0 0 1 3.8 2.75l1.13 1.9a2 2 0 0 0 2.5.8zm2.82.97a4 4 0 0 1 3.12 0l2.04.87a4 4 0 0 0 4.99-1.62l1.14-1.9a4 4 0 0 1 2.53-1.84l2.15-.5a4 4 0 0 0 3.09-4.24l-.2-2.2a4 4 0 0 1 .97-2.98l1.45-1.67a4 4 0 0 0 0-5.24l-1.45-1.67a4 4 0 0 1-.97-2.97l.2-2.2a4 4 0 0 0-3.09-4.25l-2.15-.5a4 4 0 0 1-2.53-1.84l-1.14-1.9a4 4 0 0 0-5-1.62l-2.03.87a4 4 0 0 1-3.12 0l-2.04-.87a4 4 0 0 0-4.99 1.62l-1.14 1.9a4 4 0 0 1-2.53 1.84l-2.15.5a4 4 0 0 0-3.09 4.24l.2 2.2a4 4 0 0 1-.97 2.98l-1.45 1.67a4 4 0 0 0 0 5.24l1.45 1.67a4 4 0 0 1 .97 2.97l-.2 2.2a4 4 0 0 0 3.09 4.25l2.15.5a4 4 0 0 1 2.53 1.84l1.14 1.9a4 4 0 0 0 5 1.62l2.03-.87zM152 207a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-11 1a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-6 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm3-5a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-8 8a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm3 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm0 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4 7a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm5-2a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm5 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4-6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm6-4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-4-3a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4-3a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-5-4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-24 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm16 5a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm7-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0zm86-29a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm19 9a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-14 5a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-25 1a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm5 4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm9 0a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm15 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm12-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-11-14a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-19 0a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm6 5a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-25 15c0-.47.01-.94.03-1.4a5 5 0 0 1-1.7-8 3.99 3.99 0 0 1 1.88-5.18 5 5 0 0 1 3.4-6.22 3 3 0 0 1 1.46-1.05 5 5 0 0 1 7.76-3.27A30.86 30.86 0 0 1 246 184c6.79 0 13.06 2.18 18.17 5.88a5 5 0 0 1 7.76 3.27 3 3 0 0 1 1.47 1.05 5 5 0 0 1 3.4 6.22 4 4 0 0 1 1.87 5.18 4.98 4.98 0 0 1-1.7 8c.02.46.03.93.03 1.4v1h-62v-1zm.83-7.17a30.9 30.9 0 0 0-.62 3.57 3 3 0 0 1-.61-4.2c.37.28.78.49 1.23.63zm1.49-4.61c-.36.87-.68 1.76-.96 2.68a2 2 0 0 1-.21-3.71c.33.4.73.75 1.17 1.03zm2.32-4.54c-.54.86-1.03 1.76-1.49 2.68a3 3 0 0 1-.07-4.67 3 3 0 0 0 1.56 1.99zm1.14-1.7c.35-.5.72-.98 1.1-1.46a1 1 0 1 0-1.1 1.45zm5.34-5.77c-1.03.86-2 1.79-2.9 2.77a3 3 0 0 0-1.11-.77 3 3 0 0 1 4-2zm42.66 2.77c-.9-.98-1.87-1.9-2.9-2.77a3 3 0 0 1 4.01 2 3 3 0 0 0-1.1.77zm1.34 1.54c.38.48.75.96 1.1 1.45a1 1 0 1 0-1.1-1.45zm3.73 5.84c-.46-.92-.95-1.82-1.5-2.68a3 3 0 0 0 1.57-1.99 3 3 0 0 1-.07 4.67zm1.8 4.53c-.29-.9-.6-1.8-.97-2.67.44-.28.84-.63 1.17-1.03a2 2 0 0 1-.2 3.7zm1.14 5.51c-.14-1.21-.35-2.4-.62-3.57.45-.14.86-.35 1.23-.63a2.99 2.99 0 0 1-.6 4.2zM275 214a29 29 0 0 0-57.97 0h57.96zM72.33 198.12c-.21-.32-.34-.7-.34-1.12v-12h-2v12a4.01 4.01 0 0 0 7.09 2.54c.57-.69.91-1.57.91-2.54v-12h-2v12a1.99 1.99 0 0 1-2 2 2 2 0 0 1-1.66-.88zM75 176c.38 0 .74-.04 1.1-.12a4 4 0 0 0 6.19 2.4A13.94 13.94 0 0 1 84 185v24a6 6 0 0 1-6 6h-3v9a5 5 0 1 1-10 0v-9h-3a6 6 0 0 1-6-6v-24a14 14 0 0 1 14-14 5 5 0 0 0 5 5zm-17 15v12a1.99 1.99 0 0 0 1.22 1.84 2 2 0 0 0 2.44-.72c.21-.32.34-.7.34-1.12v-12h2v12a3.98 3.98 0 0 1-5.35 3.77 3.98 3.98 0 0 1-.65-.3V209a4 4 0 0 0 4 4h16a4 4 0 0 0 4-4v-24c.01-1.53-.23-2.88-.72-4.17-.43.1-.87.16-1.28.17a6 6 0 0 1-5.2-3 7 7 0 0 1-6.47-4.88A12 12 0 0 0 58 185v6zm9 24v9a3 3 0 1 0 6 0v-9h-6z'/%3E%3Cpath d='M-17 191a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm19 9a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1zm-14 5a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-25 1a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm5 4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm9 0a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm15 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm12-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2H4zm-11-14a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-19 0a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm6 5a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-25 15c0-.47.01-.94.03-1.4a5 5 0 0 1-1.7-8 3.99 3.99 0 0 1 1.88-5.18 5 5 0 0 1 3.4-6.22 3 3 0 0 1 1.46-1.05 5 5 0 0 1 7.76-3.27A30.86 30.86 0 0 1-14 184c6.79 0 13.06 2.18 18.17 5.88a5 5 0 0 1 7.76 3.27 3 3 0 0 1 1.47 1.05 5 5 0 0 1 3.4 6.22 4 4 0 0 1 1.87 5.18 4.98 4.98 0 0 1-1.7 8c.02.46.03.93.03 1.4v1h-62v-1zm.83-7.17a30.9 30.9 0 0 0-.62 3.57 3 3 0 0 1-.61-4.2c.37.28.78.49 1.23.63zm1.49-4.61c-.36.87-.68 1.76-.96 2.68a2 2 0 0 1-.21-3.71c.33.4.73.75 1.17 1.03zm2.32-4.54c-.54.86-1.03 1.76-1.49 2.68a3 3 0 0 1-.07-4.67 3 3 0 0 0 1.56 1.99zm1.14-1.7c.35-.5.72-.98 1.1-1.46a1 1 0 1 0-1.1 1.45zm5.34-5.77c-1.03.86-2 1.79-2.9 2.77a3 3 0 0 0-1.11-.77 3 3 0 0 1 4-2zm42.66 2.77c-.9-.98-1.87-1.9-2.9-2.77a3 3 0 0 1 4.01 2 3 3 0 0 0-1.1.77zm1.34 1.54c.38.48.75.96 1.1 1.45a1 1 0 1 0-1.1-1.45zm3.73 5.84c-.46-.92-.95-1.82-1.5-2.68a3 3 0 0 0 1.57-1.99 3 3 0 0 1-.07 4.67zm1.8 4.53c-.29-.9-.6-1.8-.97-2.67.44-.28.84-.63 1.17-1.03a2 2 0 0 1-.2 3.7zm1.14 5.51c-.14-1.21-.35-2.4-.62-3.57.45-.14.86-.35 1.23-.63a2.99 2.99 0 0 1-.6 4.2zM15 214a29 29 0 0 0-57.97 0h57.96z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Detail Kelas</h3>
            </div>
            <div class="col-5 d-none d-xl-block">
            </div>
            <div class="col-xl-3 col-sm-5 box-col-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin/classroom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="m2.25 12l8.955-8.955a1.124 1.124 0 0 1 1.59 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Detail kelas</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-4 courses__details-thumb">
                <img id="class-thumbnail" class="rounded w-100" alt="Class Thumbnail"
                    style="max-height: 500px; object-fit: cover;">
            </div>
            <div class="courses__details-content">
                <h2 class="text-center title" id="title"></h2>
                <div class="mb-3 text-center courses__details-meta">
                    <ul class="list-wrap list-inline">
                        <li class="author-two list-inline-item">
                            <img id="profileUser" class="rounded-circle" alt="Profile Image"
                                style="width: 40px; height: 40px;" src="">
                            By <a href="#" id="nameTeacher"></a>
                        </li>
                    </ul>
                </div>
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="detail-tab" data-bs-toggle="tab"
                            data-bs-target="#detail-tab-pane" type="button" role="tab" aria-controls="detail-tab-pane"
                            aria-selected="true">Detail</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="materi-tab" data-bs-toggle="tab" data-bs-target="#materi-tab-pane"
                            type="button" role="tab" aria-controls="materi-tab-pane"
                            aria-selected="false">Materi</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="siswa-tab" data-bs-toggle="tab" data-bs-target="#siswa-tab-pane"
                            type="button" role="tab" aria-controls="siswa-tab-pane"
                            aria-selected="false">Siswa</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="discussion-tab" data-bs-toggle="tab"
                            data-bs-target="#discussion-tab-pane" type="button" role="tab"
                            aria-controls="discussion-tab-pane" aria-selected="false">Diskusi</button>
                    </li>
                </ul>
                <div class="mt-3 tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="detail-tab-pane" role="tabpanel" aria-labelledby="detail-tab"
                        tabindex="0">
                        <div class="courses__overview-wrap">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="title">Deskripsi Kelas</h3>
                                    <p id="description_classroom" class="mt-2 text-muted"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="materi-tab-pane" role="tabpanel" aria-labelledby="materi-tab"
                        tabindex="0">
                        <div class="courses__curriculum-wrap">
                            <h3 class="title">Materi</h3>
                            <ul class="curriculum-list list-unstyled" id="curriculum-list">
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="siswa-tab-pane" role="tabpanel" aria-labelledby="siswa-tab"
                        tabindex="0">
                        <h3 class="title">Siswa</h3>
                        <div class="row" id="student-list">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discussion-tab-pane" role="tabpanel" aria-labelledby="discussion-tab"
                        tabindex="0">
                        <h3 class="title">Diskusi</h3>
                        <div class="row" id="student-list">
                        </div>
                        {{-- diskusi --}}
                       <section class="msger mb-5d">
                                    <header class="msger-header">
                                        <div class="msger-header-title">
                                            <i class="fas fa-comment-alt"></i> Ruang Diskusi
                                        </div>
                                        <div class="msger-header-options">
                                            <span><i class="fas fa-cog"></i></span>
                                        </div>
                                    </header>
                                    <main class="msger-chat" id="kotak-pesan" style="height: 650px; overflow-y: auto;">
                                    </main>
                                    <form class="msger-inputarea" id="form-pesan">
                                        <input type="text" class="msger-input" name="message" id="input-pesan"
                                            placeholder="Tulis pesan di sini...">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="classroom_id" value="{{ $id }}">
                                        <button type="submit" class="msger-send-btn">Kirim</button>
                                    </form>
                                </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal-delete')
    @include('components.teacher.kick')
    @include('components.teacher.accept')
@endsection

@section('script')
    <script>
        const classId = '{{ $id }}';

        const ambilDataKelas = () => {
            $.ajax({
                url: `/api/student/classroom/show/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        const dataKelas = response.data;
                        $('#title').text(dataKelas.name);
                        $('#description_classroom').text(dataKelas.description);

                        const courseThumbnail = dataKelas.thumbnail ?
                            `/storage/${dataKelas.thumbnail}` : '/user.png';
                        $('#class-thumbnail').attr('src', courseThumbnail);

                        const authorImage = dataKelas.user.profile ? `/${dataKelas.user.profile}` :
                            '/user.png';
                        $('#profileUser').attr('src', authorImage);

                        $('#nameTeacher').text(dataKelas.user.name);
                        ambilDataMateri();
                        ambilDataSiswa();
                    } else {
                        $('#class-name').text('Data kelas tidak ditemukan');
                    }
                },
                error: function(xhr, status, error) {
                    $('#class-name').text('Error memuat data kelas');
                }
            });
        };

        const ambilDataMateri = () => {
            $.ajax({
                url: `/api/student/course/data/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const kontainerMateri = $('#curriculum-list');
                    kontainerMateri.empty();

                    if (response.status && response.data.length > 0) {
                        const daftarMateri = response.data;
                        daftarMateri.forEach(item => {
                            const shortDescription = item.description.length > 80 ?
                                item.description.substring(0, 80) + '...' :
                                item.description;

                            kontainerMateri.append(`
                        <li class="mb-3">
                            <div class="shadow-sm card">
                                <div class="gap-2 card-body d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M14 9.9V8.2q.825-.35 1.688-.525T17.5 7.5q.65 0 1.275.1T20 7.85v1.6q-.6-.225-1.213-.337T17.5 9q-.95 0-1.825.238T14 9.9m0 5.5v-1.7q.825-.35 1.688-.525T17.5 13q.65 0 1.275.1t1.225.25v1.6q-.6-.225-1.213-.338T17.5 14.5q-.95 0-1.825.225T14 15.4m0-2.75v-1.7q.825-.35 1.688-.525t1.812-.175q.65 0 1.275.1T20 10.6v1.6q-.6-.225-1.213-.338T17.5 11.75q-.95 0-1.825.238T14 12.65m-1 4.4q1.1-.525 2.213-.788T17.5 16q.9 0 1.763.15T21 16.6V6.7q-.825-.35-1.713-.525T17.5 6q-1.175 0-2.325.3T13 7.2zM12 20q-1.2-.95-2.6-1.475T6.5 18q-1.05 0-2.062.275T2.5 19.05q-.525.275-1.012-.025T1 18.15V6.1q0-.275.138-.525T1.55 5.2q1.175-.575 2.413-.888T6.5 4q1.45 0 2.838.375T12 5.5q1.275-.75 2.663-1.125T17.5 4q1.3 0 2.538.313t2.412.887q.275.125.413.375T23 6.1v12.05q0 .575-.487.875t-1.013.025q-.925-.5-1.937-.775T17.5 18q-1.5 0-2.9.525T12 20"/></svg>
                                    <div>
                                        <h5 class="mb-0 card-title">
                                            <a href="/admin/classroom/detail/course/${item.id}" class="text-decoration-none text-primary">${item.name}</a>
                                        </h5>
                                        <p class="card-text text-muted">${shortDescription}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `);
                        });
                    } else {
                        kontainerMateri.append('<li>Tidak ada materi ditemukan</li>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#curriculum-list').append('<li>Error memuat data materi</li>');
                }
            });
        };

        const ambilDataSiswa = () => {
            $.ajax({
                url: `/api/student/data/classroom/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        const daftarSiswa = response.data;
                        const kontainerSiswa = $('#student-list');
                        kontainerSiswa.empty();
                        if (daftarSiswa.length > 0) {
                            daftarSiswa.forEach(siswa => {
                                kontainerSiswa.append(`
                                <div class="col-xl-4 col-xxl-6 col-sm-6">
                            <div class="card contact-bx">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="image-bx me-3 me-lg-2 me-xl-3">
                                            <img src="${siswa.profile || '{{ asset('user.png') }}'}" alt="" class="rounded-circle" width="70">
                                            <span class="active"></span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0 fs-20 font-w600">
                                                <a href="javascript:void(0)" class="text-black">${siswa.name}</a>
                                            </h6>
                                            <p class="fs-14">${siswa.email}</p>
                                            <div class="gap-2 mt-2 d-flex justify-content-end">
                                                <button type="button" class="btn btn-danger btn-sm" title="Keluarkan" data-id="${siswa.id_relation}" onclick="openKickModal(${siswa.id_relation})">
Keluarkan
</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `);
                            });
                        } else {
                            kontainerSiswa.append('<p>Tidak ada siswa ditemukan</p>');
                        }
                    } else {
                        $('#student-list').append('<p>Error memuat data siswa</p>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#student-list').append('<p>Error memuat data siswa</p>');
                }
            });
        };


        $(document).ready(function() {
            ambilDataKelas();
        });


        const openKickModal = (studentId) => {
            $('#deleteClassId').val(studentId);
            $('#modal-kick-student').modal('show');
        };

        $('#form-kick').submit(function(e) {
            e.preventDefault();
            const studentId = $('#deleteClassId').val();

            $.ajax({
                url: `/api/kick/student/${studentId}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showAlert("Siswa berhasil di Keluarkan", 'success');
                    $('#modal-kick-student').modal('hide');
                    ambilDataSiswa();
                },
                error: function(xhr, status, error) {
                    console.error('Error mengeluarkan siswa:', error);
                    showAlert("Gagal mengeluarkan siswa", 'error');
                }
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            const urlAmbilPesan = `/api/forum/discussion/{{ $id }}`;
            const urlKirimPesan = `/api/forum/discussion`;
            const localStorageKey = `messages-${{{ $id }}}`;
            let lastMessageId = localStorage.getItem(localStorageKey) || 0;

            function ambilPesan() {
                const kotakPesan = $('#kotak-pesan');
                const isScrolledToBottom = kotakPesan.scrollTop() + kotakPesan.innerHeight() >= kotakPesan[0].scrollHeight;

                $.ajax({
                    url: `${urlAmbilPesan}?last_message_id=${lastMessageId}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === "success" && response.data.length > 0) {
                            tampilkanPesan(response.data, isScrolledToBottom);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Gagal mengambil pesan', error);
                    }
                });
            }

            function tampilkanPesan(pesan, isScrolledToBottom) {
                const kotakPesan = $('#kotak-pesan');
                const existingMessages = kotakPesan.find('.msg').map(function() {
                    return $(this).data('message-id');
                }).get();

                pesan.forEach(function(msg) {
                    if (existingMessages.includes(msg.id)) {
                        return;
                    }

                    const kelasPesan = msg.user_id == "{{ auth()->user()->id }}" ? 'right-msg' : 'left-msg';
                    const userImage = msg.user_id == "{{ auth()->user()->id }}" && msg.user_image ?
                                      "{{ asset('storage') }}/" + msg.user_image :
                                      "{{ asset('storage/user.png') }}";

                    const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    const htmlPesan = `
                        <div class="msg ${kelasPesan}" data-message-id="${msg.id}">
                            <div class="msg-img" style="background-image: url('${userImage}');"></div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">${msg.user_id == "{{ auth()->user()->id }}" ? 'Anda' : msg.user_name}</div>
                                    <div class="msg-info-time">${time}</div>
                                </div>
                                <div class="msg-text">${msg.message}</div>
                            </div>
                        </div>
                    `;
                    kotakPesan.append(htmlPesan);
                    lastMessageId = msg.id;
                });

                localStorage.setItem(localStorageKey, lastMessageId);

                if (isScrolledToBottom) {
                    kotakPesan.scrollTop(kotakPesan.prop('scrollHeight'));
                }
            }

            $('#form-pesan').submit(function(event) {
                event.preventDefault();
                const formData = $(this).serialize();
                $.ajax({
                    url: urlKirimPesan,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status === "success" && response.data) {
                            const pesanBaru = response.data;
                            const kelasPesan = pesanBaru.user_id == "{{ auth()->user()->id }}" ? 'right-msg' : 'left-msg';

                            const userImage = pesanBaru.user_id == "{{ auth()->user()->id }}" && pesanBaru.user_image ?
                                              "{{ asset('storage') }}/" + pesanBaru.user_image :
                                              "{{ asset('storage/user.png') }}";

                            const time = new Date(pesanBaru.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                            const htmlPesan = `
                                <div class="msg ${kelasPesan}" data-message-id="${pesanBaru.id}">
                                    <div class="msg-img" style="background-image: url('${userImage}');"></div>
                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">Anda</div>
                                            <div class="msg-info-time">${time}</div>
                                        </div>
                                        <div class="msg-text">${pesanBaru.message}</div>
                                    </div>
                                </div>
                            `;
                            $('#kotak-pesan').append(htmlPesan).scrollTop($('#kotak-pesan').prop('scrollHeight'));
                            $('#input-pesan').val('');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Gagal mengirim pesan', error);
                    }
                });
            });

            ambilPesan();
            setInterval(ambilPesan, 2000);
        });
    </script>
@endsection
