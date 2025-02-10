import React, { useState } from 'react';
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
    const memo = window.__INITIAL_DATA__ || {};

    const [isLoading, setIsLoading] = useState(false);
    const [isModalOpen, setIsModalOpen] = useState(false);

    let isPreview = false;
    if (memo['view']) {
        isPreview = true;
    }

    let initialContent = [{
        type: "paragraph",
        content: "",
    }];
    if (memo['content_json'] !== '') {
        const decoded = decodeHtmlEntities(memo['content_json']);
        initialContent = JSON.parse(decoded);
    }

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

    return (
        <div>
            {isModalOpen && (
                <div class="modal-overlay">
                    <div class="modal-content">
                        <span class="modal-close" onClick={() => setIsModalOpen(false)}>&times;</span>
                        <h2>メモの公開</h2>
                        <p>以下のリンクから誰でもメモを観覧できます｡</p>
                        <a target='_blank' href={`/view/${memo['memo_id']}`}>{window.location.hostname}{`/view/${memo['memo_id']}`}</a>
                    </div>
                </div>
            )}
            <div>
                <div className="content-header">
                    <span className="content-title">{memo['title']}</span>
                    {!isPreview && (
                        <div className="header-btns">
                            <button
                                className="btn-accent header-btn"
                                disabled={isLoading}
                                onClick={async () => {
                                    setIsLoading(true);
                                    const params = new URLSearchParams();
                                    params.append('memo_id', memo['memo_id']);
                                    params.append('is_published', parseInt(memo['is_published']) ? 0 : 1);
                                    const response = await fetch('/api/memo/update', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                        },
                                        body: params.toString(),
                                    });
                                    setIsLoading(false);
                                    if (response.ok) {
                                        memo['is_published'] = parseInt(memo['is_published']) ? 0 : 1;
                                        if (parseInt(memo['is_published'])) {
                                            setIsModalOpen(true);
                                        }
                                    }
                                }}>
                                {parseInt(memo['is_published']) ? '公開中' : '公開する'}
                            </button>
                            <button
                                className="btn-primary header-btn"
                                disabled={isLoading}
                                onClick={async () => {
                                    setIsLoading(true);
                                    const json_data = editor.document;
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
                                        window.location.href = '/';
                                    } else {
                                        setIsLoading(false);
                                    }
                                }}>
                                保存する
                            </button>
                        </div>
                    )}
                </div>
            </div>
            <div className="editor-container">
                <BlockNoteView editor={editor} theme={{ light: customTheme, dark: customTheme }} editable={!isPreview} />
                {isLoading &&
                    <div className="spinner-overlay">
                        <div className="spinner"></div>
                    </div>
                }
            </div>
        </div>
    );
}

// Render your React component instead
const root = createRoot(document.getElementById('editor'));
root.render(<App />);
