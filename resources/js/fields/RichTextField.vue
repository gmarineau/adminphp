<script setup lang="ts">
import { Placeholder } from '@tiptap/extensions'
import StarterKit from '@tiptap/starter-kit'
import { EditorContent, useEditor, type JSONContent } from '@tiptap/vue-3'
import { onBeforeUnmount, onMounted, watch } from 'vue'
import { useLocalizedValue } from '../composables/useLocalizedValue'
import type { RichTextFieldSchema } from '../types'

const props = defineProps<{
    field: RichTextFieldSchema
    modelValue: unknown
    autofocus?: boolean
}>()

const emit = defineEmits<{ 'update:modelValue': [value: unknown] }>()

const { value, isMissingTranslation } = useLocalizedValue<JSONContent>(props, emit)

const editor = useEditor({
    extensions: [
        StarterKit.configure({ heading: { levels: [2, 3] }, link: { openOnClick: false } }),
        Placeholder.configure({ placeholder: () => (isMissingTranslation.value ? 'Pas encore traduit' : 'Écrivez ici…') }),
    ],
    content: value.value ?? '',
    onUpdate: ({ editor }) => {
        value.value = editor.isEmpty ? null : editor.getJSON()
    },
})

/**
 * Reloads the document when the value changes from outside (locale switch, reload).
 */
watch(value, (newValue) => {
    if (!editor.value) {
        return
    }

    const isSameDocument = JSON.stringify(newValue ?? null) === JSON.stringify(editor.value.isEmpty ? null : editor.value.getJSON())

    if (!isSameDocument) {
        editor.value.commands.setContent(newValue ?? '', { emitUpdate: false })
    }
})

/**
 * The editor is created on mount and its DOM attached by EditorContent afterwards,
 * so autofocus waits for the next task before focusing.
 */
onMounted(() => {
    if (props.autofocus) {
        setTimeout(() => editor.value?.view.focus())
    }
})

onBeforeUnmount(() => editor.value?.destroy())
</script>

<template>
    <div class="rich-text" :class="{ missing: isMissingTranslation }">
        <div v-if="editor" class="rich-toolbar" role="toolbar" aria-label="Mise en forme">
            <button type="button" :aria-pressed="editor.isActive('bold')" title="Gras" @click="editor.chain().focus().toggleBold().run()"><b>G</b></button>
            <button type="button" :aria-pressed="editor.isActive('italic')" title="Italique" @click="editor.chain().focus().toggleItalic().run()"><i>I</i></button>
            <button type="button" :aria-pressed="editor.isActive('heading', { level: 2 })" title="Intertitre" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()">H2</button>
            <button type="button" :aria-pressed="editor.isActive('bulletList')" title="Liste" @click="editor.chain().focus().toggleBulletList().run()">•</button>
        </div>
        <EditorContent :editor="editor" class="prose" />
    </div>
</template>
