import React from 'react';
import { createRoot } from 'react-dom/client';
import "@blocknote/core/fonts/inter.css";
import { BlockNoteView } from "@blocknote/mantine";
import "@blocknote/mantine/style.css";
import { useCreateBlockNote } from "@blocknote/react";
import { locales } from "@blocknote/core";
import "./editor.css";

export default function App() {
    const memo = window.__INITIAL_DATA__ || [];

    const editor = useCreateBlockNote({
        dictionary: locales.ja,
    });

    const customTheme = {
        colors: {
            editor: {
                text: "#373530",
                background: "#fdfbf8",
            },
        },
    };

    return (<div>
        <div >
            <div class="content-header">
                <span class="content-title">{memo['title']}</span>
                <div class="header-btns">
                    <button class="btn-primary header-btn">公開する</button>
                    <button class="btn-primary header-btn" onClick={() => {
                        const json_data = editor.document;
                        const html_data = editor.blocksToFullHTML(editor.document);
                        // fetch('/edit/update', {
                        //     method: 'POST',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //     },
                        //     body: JSON.stringify({
                        //         memo_id: memo['memo_id'],
                        //         json: json_data,
                        //         html: html_data,
                        //     }),
                        // })
                    }}>保存する</button>
                </div>
            </div>
            <div class="editor-container">
                <BlockNoteView editor={editor} theme={{ light: customTheme, dark: customTheme }} />
            </div>
        </div>
    </div>);
}

// Render your React component instead
const root = createRoot(document.getElementById('editor'));
root.render(<App />);
