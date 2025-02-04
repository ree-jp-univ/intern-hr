import React from 'react';
import { createRoot } from 'react-dom/client';
import "@blocknote/core/fonts/inter.css";
import { BlockNoteView } from "@blocknote/mantine";
import "@blocknote/mantine/style.css";
import { useCreateBlockNote } from "@blocknote/react";
import { locales } from "@blocknote/core";
import "./editor.css";

export default function App() {
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
        <div class="editor-container">
            <div class="content-header">
                <span class="content-title">タイトル</span>
                <div class="header-btns">
                    <button class="btn-primary header-btn">公開する</button>
                    <button class="btn-primary header-btn">保存する</button>
                </div>
            </div>
            {/* <div class="editor-container"> */}
                <BlockNoteView editor={editor} theme={{ light: customTheme, dark: customTheme }} />
            {/* </div> */}
        </div>
    </div>);
}

// Render your React component instead
const root = createRoot(document.getElementById('editor'));
root.render(<App />);
