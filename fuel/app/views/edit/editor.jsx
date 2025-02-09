import React from 'react';
import { createRoot } from 'react-dom/client';
import "@blocknote/core/fonts/inter.css";
import { BlockNoteView } from "@blocknote/mantine";
import "@blocknote/mantine/style.css";
import { useCreateBlockNote } from "@blocknote/react";
import { locales } from "@blocknote/core";
import "./editor.css";

// HTMLエンティティをデコードする関数
function decodeHtmlEntities(str) {
    const txt = document.createElement("textarea");
    txt.innerHTML = str;
    return txt.value;
}

export default function App() {
    const memo = window.__INITIAL_DATA__ || [];

    let initialContent = [{
        type: "paragraph",
        content: "",
    }];
    const decoded = decodeHtmlEntities(memo['content_json']);
    initialContent = JSON.parse(decoded);

    const editor = useCreateBlockNote({
        initialContent: initialContent,
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
                    <button class="btn-primary header-btn" onClick={async () => {
                        const json_data = editor.document;
                        // const html_data = editor.blocksToFullHTML(editor.document);
                        const params = new URLSearchParams();
                        params.append('memo_id', memo['memo_id']);
                        params.append('content_json', JSON.stringify(json_data));
                        const response = await fetch('/api/memo/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: params.toString(),
                        });
                    
                        if (response.ok) {
                            // 更新成功後にホーム画面にリダイレクト
                            window.location.href = '/';
                        }
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
