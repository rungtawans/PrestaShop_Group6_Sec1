import { test, expect } from '@playwright/test';

test('test', async ({ page }) => {
  await page.goto('http://localhost:8080/en/');
  await page.goto('http://localhost:8080/en/home/32-voucher-1000-baht.html');
  await page.getByRole('button', { name: ' Add to cart' }).click();
  await page.getByRole('link', { name: ' Proceed to checkout' }).click();
  await page.getByRole('link', { name: 'Proceed to checkout' }).click();
  await page.getByLabel('yes').check();
  await page.getByRole('button',{name : 'Continue'}).click();
  await page.locator('#delivery-address #field-firstname').click();
  await page.locator('#delivery-address #field-firstname').fill('Somsri');
  await page.locator('#delivery-address #field-lastname').click();
  await page.locator('#delivery-address #field-lastname').fill('sodsai');
  await page.getByLabel('VAT number').click();
  await page.getByLabel('VAT number').fill('0000-0-0000-0-001');
  await page.getByLabel('Address', { exact: true }).click();
  await page.getByLabel('Address', { exact: true }).fill('29/1');
  await page.getByLabel('Zip/Postal Code').click();
  await page.getByLabel('Zip/Postal Code').fill('40000');
  await page.getByLabel('City').click();
  await page.getByLabel('City').fill('Khon kaen');
  await page.getByLabel('State').selectOption('369');
  await page.getByLabel('Phone').click();
  await page.getByLabel('Phone').fill('095-877-5441');
  await page.getByRole('button',{name : 'Continue'}).click();
  await page.getByText('Promptpay number').click();
  await page.getByRole('textbox').click();
  await page.getByRole('textbox').setInputFiles('tests/qrcode.jpg');
  await page.getByRole('button', { name: 'Place Order' }).click();
});