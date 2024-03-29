import { test, expect } from '@playwright/test';

test('test', async ({ page }) => {
  await page.goto('http://localhost:8080/en/');
  await page.locator('.thumbnail').first().click();
  await page.getByRole('button', { name: ' Add to cart' }).click();
  await page.getByRole('link', { name: ' Proceed to checkout' }).click();
  await page.getByRole('link', { name: 'Proceed to checkout' }).click();
  await page.getByLabel('yes').check();
  await page.getByRole('button',{name : 'Continue'}).click();
  await page.locator('#delivery-address #field-firstname').click();
  await page.locator('#delivery-address #field-firstname').fill('5');
  await page.locator('#delivery-address #field-firstname').press('Tab');
  await page.locator('#delivery-address #field-lastname').fill('sodsai');
  await page.locator('#delivery-address #field-lastname').press('Tab');
  await page.getByLabel('Company').press('Tab');
  await page.getByLabel('VAT number').fill('0000-0-0000-0-001');
  await page.getByLabel('Address', { exact: true }).click();
  await page.getByLabel('Address', { exact: true }).fill('29/1');
  await page.getByLabel('Zip/Postal Code').click();
  await page.getByLabel('Zip/Postal Code').fill('40000');
  await page.getByLabel('City').click();
  await page.getByLabel('City').fill('Khon kaen');
  await page.getByLabel('Phone').click();
  await page.getByLabel('Phone').fill('095-877-5441');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.locator('#delivery-address #field-firstname').click();
  await page.locator('#delivery-address #field-firstname').fill('Somsri');
  await page.locator('#delivery-address #field-lastname').click();
  await page.locator('#delivery-address #field-lastname').fill('5');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.locator('#delivery-address #field-lastname').click();
  await page.locator('#delivery-address #field-lastname').fill('sodsai');
  await page.getByLabel('Zip/Postal Code').click();
  await page.getByLabel('Zip/Postal Code').fill('w');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByLabel('Zip/Postal Code').click();
  await page.getByLabel('Zip/Postal Code').fill('534');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByLabel('Zip/Postal Code').click();
  await page.getByLabel('Zip/Postal Code').fill('40000');
  await page.getByLabel('City').click();
  await page.getByLabel('City').fill('Khon');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByRole('heading', { name: ' Personal Information and' }).click();
  await page.getByRole('link', { name: ' Edit' }).click();
  await page.getByLabel('VAT number').dblclick();
  await page.getByLabel('VAT number').press('Control+s');
  await page.getByLabel('VAT number').press('Control+a');
  await page.getByLabel('VAT number').fill('w');
  await page.getByLabel('City').click();
  await page.getByLabel('City').fill('Khon kaen');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByRole('heading', { name: ' Personal Information and' }).click();
  await page.getByRole('link', { name: ' Edit' }).click();
  await page.getByLabel('VAT number').click();
  await page.getByLabel('VAT number').fill('0000-0-0001');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByText(' 2 Personal Information and Address mode_edit Edit The selected address will').click();
  await page.getByRole('link', { name: ' Edit' }).click();
  await page.locator('#delivery-address #field-firstname').click();
  await page.locator('#delivery-address #field-firstname').fill(' ');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByRole('heading', { name: ' Personal Information and' }).click();
  await page.getByRole('link', { name: ' Edit' }).click();
  await page.locator('#delivery-address #field-firstname').click();
  await page.locator('#delivery-address #field-firstname').fill('*');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByRole('heading', { name: ' Personal Information and' }).click();
  await page.getByRole('link', { name: ' Edit' }).click();
  await page.locator('#delivery-address #field-firstname').click();
  await page.locator('#delivery-address #field-firstname').fill('Somsri');
  await page.locator('#delivery-address #field-lastname').click();
  await page.locator('#delivery-address #field-lastname').fill('*');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByRole('heading', { name: ' Personal Information and' }).click();
  await page.getByRole('link', { name: ' Edit' }).click();
  await page.locator('#delivery-address #field-lastname').click();
  await page.locator('#delivery-address #field-lastname').fill(' ');
  await page.getByRole('button', { name: 'Continue' }).click();
  await page.getByRole('heading', { name: ' Personal Information and' }).click();
});