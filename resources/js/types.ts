export interface AdminConfig {
    basePath: string
    apiUrl: string
    locales: string[]
    defaultLocale: string
}

export interface BaseFieldSchema {
    name: string
    label: string
    translatable: boolean
    required: boolean
}

export interface TextFieldSchema extends BaseFieldSchema {
    type: 'text'
    multiline: boolean
    maxLength: number
}

export interface RichTextFieldSchema extends BaseFieldSchema {
    type: 'rich-text'
}

export interface BlockSchema {
    type: string
    title: string
    version: number
    fields: FieldSchema[]
}

export interface BlocksFieldSchema extends BaseFieldSchema {
    type: 'blocks'
    blocks: BlockSchema[]
}

export type FieldSchema = TextFieldSchema | RichTextFieldSchema | BlocksFieldSchema

export interface ModuleSchema {
    name: string
    title: string
    fields: FieldSchema[]
}

export interface ModuleSummary {
    name: string
    title: string
    count: number
}

export interface ItemSummary {
    id: string
    title: string
    updatedAt: string | null
}

export interface BlockValue {
    id: string
    type: string
    content: Record<string, unknown>
}

export type FormValues = Record<string, unknown>

export interface Item {
    id: string
    title: string
    values: FormValues
}

export type ValidationErrors = Record<string, string[]>
