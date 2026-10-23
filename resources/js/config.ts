import type { AdminConfig } from './types'

declare global {
    interface Window {
        AdminPhp: AdminConfig
    }
}

export const config: AdminConfig = window.AdminPhp
